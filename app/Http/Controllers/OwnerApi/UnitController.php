<?php

namespace App\Http\Controllers\OwnerApi;

use App\Models\Review;
use App\Models\Booking;
use App\Models\Payment;
use App\Traits\ApiResponse;
use App\Enums\BookingStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Owner\UnitResource;
use App\Http\Resources\Owner\ReviewResource;
use App\Http\Resources\Owner\BookingResource;
use App\Http\Resources\Owner\PaymentResource;
use App\Models\Unit;

class UnitController extends Controller
{
    use ApiResponse;

    public function units(Request $request)
    {
        $data = Unit::where('user_id', $request->user()->id)->get();
        return $this->listResponse(UnitResource::collection($data));
    }

    public function show(Request $request, $code)
    {
        $unit = Unit::where('code', $code)->first();
        if (!$unit) {
            return $this->notFoundResponse();
        }

        if ($unit->user_id == $request->user()->id) {
            return $this->listResponse(new UnitResource($unit));
        } else {
            return $this->unAuthorizedResponse();
        }
    }
}
