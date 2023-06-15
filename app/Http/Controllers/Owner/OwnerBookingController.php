<?php

namespace App\Http\Controllers\Owner;

use App\Models\Booking;
use App\Enums\BookingStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OwnerBookingController extends Controller
{
    const DIRECTORY = 'owner.bookings';

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

        $data = Booking::owner()->when($word != null, function ($q) use ($word) {
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
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        if ($booking->unit->user_id != Auth::guard('owner')->user()->id) {
            abort(404);
        }
        return view(self::DIRECTORY . ".show", \get_defined_vars())->with('directory', self::DIRECTORY);
    }
}
