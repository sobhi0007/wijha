<?php

namespace App\Http\Controllers\OwnerApi;

use App\Models\Review;
use App\Models\Booking;
use App\Traits\ApiResponse;
use App\Enums\BookingStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Owner\BookingResource;
use App\Http\Resources\Owner\PaymentResource;
use App\Http\Resources\Owner\ReviewResource;
use App\Models\Payment;

class PaymentController extends Controller
{
    use ApiResponse;

    public function payments(Request $request)
    {
        $data = Payment::whereHas('booking', function ($q) use ($request) {
            $q->whereHas('unit', function ($qu) use ($request) {
                $qu->where('user_id', $request->user()->id);
            });
        })->get();
        return $this->listResponse(PaymentResource::collection($data));
    }

    public function show(Request $request, $id)
    {
        $payment = Payment::find($id);
        if (!$payment) {
            return $this->notFoundResponse();
        }

        if ($payment->booking?->unit?->user_id == $request->user()->id) {
            return $this->listResponse(new PaymentResource($payment));
        } else {
            return $this->unAuthorizedResponse();
        }
    }
}
