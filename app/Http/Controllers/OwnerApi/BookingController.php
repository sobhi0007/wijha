<?php

namespace App\Http\Controllers\OwnerApi;

use App\Models\Booking;
use App\Traits\ApiResponse;
use App\Enums\BookingStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Owner\BookingResource;

class BookingController extends Controller
{
    use ApiResponse;

    public function bookings(Request $request)
    {
        $status = $request->status ?? null;

        $data = Booking::whereHas('unit', function ($q) use ($request) {
            $q->where('user_id', $request->user()->id);
        })->when($status != null, function ($q) use ($status) {
            $q->where('status', $status);
        })->get();
        return $this->listResponse(BookingResource::collection($data));
    }

    public function show(Request $request, $reference_number)
    {
        $data = Booking::whereHas('unit', function ($q) use ($request) {
            $q->where('user_id', $request->user()->id);
        })->where('reference_number', $reference_number)->first();
        if ($data) {
            return $this->listResponse(new BookingResource($data));
        } else {
            return $this->notFoundResponse();
        }
    }

    public function bookingsStatuses()
    {
        $data = [];
        foreach (BookingStatus::cases() as $case) {
            if ($case->value != 0) {
                array_push($data, [$case->value => $case->lang()]);
            }
        }
        return $this->listResponse($data);
    }
}
