<?php

namespace App\Http\Controllers\Home;

use App\Enums\ReviewStatus;
use App\Enums\UnitStatus;
use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\City;
use App\Models\Unit;
use App\Models\User;
use App\Models\Booking;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Http\Requests\Home\SearchRequest;

class UnitController extends Controller
{

    public function show(Unit $unit )
    {
        $lang =app()->getLocale();
        $unit = Unit::where('id',$unit->id)->where('status',UnitStatus::PUBLISHED)->with(['reviews'=> function ($query) {
            $query->where('status', ReviewStatus::ACTIVE);
        }])->get()->first();
        $unit ?: abort(404);

        $bookedDates = Booking::where('unit_id',$unit->id)->get(['from_datetime','to_datetime']);


        $dateRanges = $bookedDates->flatMap(function ($booking) {
        $from = new DateTime(max($booking->from_datetime, date('Y-m-d')));
        $to = new DateTime($booking->to_datetime);
        $dates = [];
    
        $period = new DatePeriod(
            $from,
            new DateInterval('P1D'),
            $to->modify('+1 day')
        );
    
        foreach ($period as $date) {
            $dates[] = $date->format('Y-m-d');
        }
    
        return $dates;
    })->unique()->values()->toArray();
    
    usort($dateRanges, function($a, $b) {
        $dateA = new DateTime($a);
        $dateB = new DateTime($b);
        return $dateA <=> $dateB;
    });
    
 $dateRanges = implode(',',$dateRanges);
  
  
           $city = City::find($unit->city_id)['name_'.app()->getLocale()];
           $user = user::find($unit->user_id);
            $images=$unit->getMedia('images');
            $x=[];
            foreach ($images as $image) {
                $x[] = $image->getUrl('responsive');
            }
            $unit['image'] =$x;
           
            $categories = Category::get(['name_'.app()->getLocale() .' as name', 'slug']);
      return  view('home.unit', compact('unit','categories','city','user','dateRanges' ));
    }
}
