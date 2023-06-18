<?php

namespace App\Http\Controllers\OwnerApi;

use App\Models\Review;
use App\Models\Booking;
use App\Traits\ApiResponse;
use App\Enums\BookingStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Owner\BookingResource;
use App\Http\Resources\Owner\ReviewResource;

class ReviewController extends Controller
{
    use ApiResponse;

    public function reviews(Request $request)
    {
        $data = Review::whereHas('booking', function ($q) use ($request) {
            $q->whereHas('unit', function ($qu) use ($request) {
                $qu->where('user_id', $request->user()->id);
            });
        })->published()->get();
        return $this->listResponse(ReviewResource::collection($data));
    }

    public function show(Request $request, $id)
    {
        $review = Review::find($id);
        if (!$review) {
            return $this->notFoundResponse();
        }

        if ($review->booking?->unit?->user_id == $request->user()->id) {
            return $this->listResponse(new ReviewResource($review));
        } else {
            return $this->unAuthorizedResponse();
        }
    }
}
