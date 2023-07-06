<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Time;
use App\Models\Unit;
use App\Models\User;
use App\Models\Booking;
use Carbon\CarbonPeriod;
use App\Enums\BookingStatus;
use Illuminate\Http\Request;
use App\Enums\TimeAvailability;
use App\Notifications\Reservation;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    const DIRECTORY = 'dashboard.bookings';

    function __construct()
    {
        $this->middleware('check_permission:list_bookings')->only(['index', 'getData']);
        $this->middleware('check_permission:add_bookings')->only(['create', 'store']);
        $this->middleware('check_permission:show_bookings')->only(['show']);
        $this->middleware('check_permission:edit_bookings')->only(['edit', 'update']);
        $this->middleware('check_permission:delete_bookings')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->getData($request->all());
        $pageName = '';
        if ($data['status'] == null) {
            $pageName = 'all_bookings';
        } else if ($data['status'] == BookingStatus::DRAFT->value) {
            $pageName = 'draft_bookings';
        } else if ($data['status'] == BookingStatus::APPROVED->value) {
            $pageName = 'approved_bookings';
        } else if ($data['status'] == BookingStatus::COMPLETED->value) {
            $pageName = 'completed_bookings';
        } else if ($data['status'] == BookingStatus::REJECTED->value) {
            $pageName = 'rejected_bookings';
        } else if ($data['status'] == BookingStatus::CANCELLED->value) {
            $pageName = 'cancelled_bookings';
        } else if ($data['status'] == BookingStatus::PENDING->value) {
            $pageName = 'pending_bookings';
        }
        return view(self::DIRECTORY . ".index", \get_defined_vars())->with('directory', self::DIRECTORY);
    }

    /**
     * Get data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData($data)
    {
        $order   = $data['order'] ?? 'created_at';
        $sort    = $data['sort'] ?? 'desc';
        $perpage = $data['perpage'] ?? \config('app.paginate');
        $start   = $data['start'] ?? null;
        $end     = $data['end'] ?? null;
        $word    = $data['word'] ?? null;
        $status  = $data['status'] ?? null;

        $data = Booking::when($word != null, function ($q) use ($word) {
            $q->where('reference_number', 'like', '%' . $word . '%');
        })
            ->when($status != null, function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->when($start != null, function ($q) use ($start) {
                $q->whereDate('from_datetime', '>=', $start);
            })
            ->when($end != null, function ($q) use ($end) {
                $q->whereDate('to_datetime', '<=', $end);
            })
            ->orderby($order, $sort)->paginate($perpage);

        return \get_defined_vars();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all(['id', 'name_en', 'name_ar']);
        return view(self::DIRECTORY . ".create", get_defined_vars())->with('directory', self::DIRECTORY);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookingRequest $request)
    {

        $data = $request->validated();
        $unit = Unit::find($data['unit_id']);
        if (!$unit) throw ValidationException::withMessages(['unit_id' => __('messages.no_units_found')]);
        $data['unit_id'] = $unit->id;
        // check if there are any bookings on the same unit and same dates 
        $bookings = Booking::where('unit_id', $unit->id)->where(function ($q) use ($data) {
            $q->whereDate('from_datetime', '>=', $data['from_datetime'])->whereDate('to_datetime', '<=', $data['to_datetime']);
        })->count();
        $times = false;
        $period = CarbonPeriod::create($data['from_datetime'], $data['to_datetime'])->toArray();
        foreach ($period as $date) {
            $day = $date->format('Y-m-d');
            $existDay = Time::where('unit_id', $unit->id)->where('availability', TimeAvailability::NOTAVAILABLE)
                ->whereDate('from', '<=', $date)
                ->whereDate('to', '>=', $date)
                ->first();
            if ($existDay) {
                $times = true;
                break;
            }
        }
        if ($bookings > 0 || $times == true) throw ValidationException::withMessages(['unit_id' => __('messages.no_available_slots')]);
        $record = Booking::create($data);
        return response()->json(['success' => __('messages.sent')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        return view(self::DIRECTORY . ".show", \get_defined_vars())->with('directory', self::DIRECTORY);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        return view(self::DIRECTORY . ".edit", \get_defined_vars())->with('directory', self::DIRECTORY);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookingRequest  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {

        $user = User::findOrFail($booking->user_id);
        $unit = Unit::findOrFail($booking->unit_id);
        $data = $request->validated();
        switch ($data['status']) {

            case BookingStatus::APPROVED->value:
              $user->notify( new Reservation($unit , $user , __('lang.booked_success_title'), __('lang.booked_success_body').' '.$unit->title.' '.__('lang.thanks')));
              $this->sendFCMNotification( __('lang.booked_success_title'), __('lang.booked_success_body').' '.$unit->title.' '.__('lang.thanks'),$user);
            break;

            case BookingStatus::CANCELLED->value:
                $user->notify( new Reservation($unit , $user , __('lang.booked_cancelled_title'), __('lang.booked_cancelled_body').' '.$unit->title.' '.__('lang.thanks')));
                $this->sendFCMNotification( __('lang.booked_cancelled_title'), __('lang.booked_cancelled_body').' '.$unit->title.' '.__('lang.thanks'),$user);
            break;

            case BookingStatus::COMPLETED->value:
                $user->notify( new Reservation($unit , $user , __('lang.booked_completed_title'), __('lang.booked_completed_body').' '.$unit->title.' '.__('lang.thanks')));
                $this->sendFCMNotification( __('lang.booked_completed_title'), __('lang.booked_completed_body').' '.$unit->title.' '.__('lang.thanks'),$user);
            break;

            case BookingStatus::PENDING->value:
                $user->notify( new Reservation($unit , $user , __('lang.booked_pending_title'), __('lang.booked_pending_body').' '.$unit->title.' '.__('lang.thanks')));
                $this->sendFCMNotification( __('lang.booked_pending_title'), __('lang.booked_pending_body').' '.$unit->title.' '.__('lang.thanks'),$user);
            break;

            case BookingStatus::REJECTED->value:
                $user->notify( new Reservation($unit , $user , __('lang.booked_rejected_title'), __('lang.booked_rejected_body').' '.$unit->title.' '.__('lang.thanks')));
                $this->sendFCMNotification( __('lang.booked_rejected_title'), __('lang.booked_rejected_body').' '.$unit->title.' '.__('lang.thanks'),$user);
            break;
          
        }


        $booking->update($data);
        return response()->json(['success' => __('messages.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return response()->json(['success' => __('messages.deleted')]);
    }



    
  protected function sendFCMNotification($title , $body,$user)
  {
    
      $firebaseToken = array($user->fcm_token) ;
        
      $SERVER_API_KEY = 'AAAAuU4C0eo:APA91bFzRVlCxfg_9X4D1kBNr6wqqdUmcQBRZMqoYXAzMjezGp8CZobqoMZj7X0fUzWzOB_GArT6IfnDcdvlpPDTbBRcsgL9nbEd8TcCvmOyiMXbKQSUBbMzKb-xD2BDH8EUVpk7BNHJ';

      $data = [
          "registration_ids" => $firebaseToken,
          "notification" => [
              "title" => $title,
              "body" => $body,  
          ]
      ];
      $dataString = json_encode($data);
  
      $headers = [
          'Authorization: key=' . $SERVER_API_KEY,
          'Content-Type: application/json',
      ];
  
      $ch = curl_init();
    
      curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
      $response = curl_exec($ch);
  

  }
}
