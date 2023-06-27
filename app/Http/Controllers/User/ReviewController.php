<?php

namespace App\Http\Controllers\User;

use App\Models\Unit;
use App\Models\Review;
use App\Models\Booking;
use App\Enums\ReviewStatus;
use App\Enums\BookingStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;

class ReviewController extends Controller
{  

    public function submitRate(StoreReviewRequest $request){
      
        $unit= Unit::where('code',$request->code)->firstOrFail();  
        $booking =  Booking::where('id',$request->booking)
        ->where('user_id',auth()->user()->id)
        ->where('unit_id',$unit->id)
        ->where('status',BookingStatus::COMPLETED->value)
        ->firstOrFail(); 


        if(!$booking->review()->where('booking_id', $booking->id)->exists()){
            Review::create([
                'overall_rating'=> $request->rate ,
                'booking_id'=> $booking->id ,
                'unit_id'=> $unit->id ,
                'review'=> $request->review ,
                'status'=> ReviewStatus::INACTIVE->value ,
          ]);
          return redirect()->back()->with('success', __('lang.rate.success'));

        } 
        
        return redirect()->back()->with('fail', __('lang.rate.fail'));
    }

}
