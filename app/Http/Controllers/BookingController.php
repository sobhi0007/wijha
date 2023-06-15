<?php

namespace App\Http\Controllers;

use App\Models\Time;
use App\Models\Unit;
use App\Models\Booking;
use Carbon\CarbonPeriod;
use App\Enums\BookingStatus;
use Illuminate\Http\Request;
use App\Enums\TimeAvailability;
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
        $unit = Unit::where('code', $data['unit_id'])->first();
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
        $data = $request->validated();
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
}
