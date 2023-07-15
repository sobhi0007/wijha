<?php

namespace App\Http\Controllers\Home;

use App\Enums\ReviewStatus;
use App\Enums\UnitStatus;
use App\Enums\UserApproval;
use App\Enums\UserType;
use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\City;
use App\Models\Unit;
use App\Models\User;
use App\Models\Booking;
use App\Models\Category;
use App\Http\Controllers\Controller;

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


    public function ownerUnits(User $user){
        $owner = User::where('type' , UserType::OWNER)
        ->where('approval' , UserApproval::APPROVED)
        ->where('id' , $user->id)
        ->get()->first();
        $owner ?:abort(404);
    
       $units =  $owner->units;

        foreach ($units as $key => $unit) {
                $images=$unit->getMedia('images');
                $x=[];
                foreach ($images as $image) {
                    $x[] = $image->getUrl('responsive');
                }
                $unit['image'] =$x;

            }
            
        foreach ($units as $key => $unit) {
            $x= '<div class="card border-0" style="width: 18rem;">'.
            '<div id="carouselExampleIndicatorsss" class="carousel slide" data-bs-ride="carousel">'.
            '<div class="carousel-indicators">';
            $img_num=0;
                foreach ($unit->image as $image) {
                    $x.='<button type="button" data-bs-target="#carouselExampleIndicatorsss" data-bs-slide-to="'. $img_num.'" class="';
                    $x.= $img_num == 0 ?'active" aria-current="true" ':'';
                    
                    $x.= '" aria-label="Slide '. $img_num.'"></button>';
                    $img_num++;
                }
            $x.='</div>'.
            '<div class="carousel-inner " style="width:100%; height: 200px !important;">';
            $img_num=0;
                foreach ($unit->image as $image) {
                $x.=   '<div class="carousel-item  ';
                $x.= $img_num==0?' active':'';
                $x.='" >
                    <img src="'.$image.'" class="d-block w-100" alt="..." >'.
                    '</div>';
                    $img_num++;
                }
            $x.=  '</div>'.
            '<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicatorsss" data-bs-slide="prev">'.
            '<span class="carousel-control-prev-icon" aria-hidden="true"></span>'.
            '<span class="visually-hidden">Previous</span>'.
            '</button>'.
            '<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicatorsss" data-bs-slide="next">'.
            '<span class="carousel-control-next-icon" aria-hidden="true"></span>'.
            '<span class="visually-hidden">Next</span>'.
            '</button>'.
            '</div>'.
            '<div class="px-3">'.
            
            '<div class="my-2 h6">'.

            '<span class="fw-bold">'.$unit->title.'</span>'.
            '</div>'.
            '<div class="my-1">'.
            '<i class="fa-solid fa-location-dot main-color"></i> '.
            '<span class="text-muted ms-2">Entire cabin in 1 Anzinger Court</span>'.
            '</div>'.
            '<hr class="w-25">'.
            '<div class="row ">'.
            '<div class="col-6"><span class="fw-bold h6 text-main">'.  $unit->price.' '.__('lang.currency').' </span></div>'.
            '<div class="col-6 d-flex justify-content-end"> <span class="fw-bold h6"><i class="fa-solid fa-star text-warning "></i> 48 </span> <span class="text-muted ms-1 h6"> (28)</span> </div>'.
            '</div>'.
            '</div>'.
            '</div>';
            $unit['html']= $x;
            $x= $unit['coordinates'];
            $x=  json_decode($x,true);
            $unit['lat']= $x['lat'];
            $unit['long']= $x['long'];


        }
        $wishlists= !auth()->user()?[]:auth()->user()->wishlist;
        return view('home.ownerUnits') 
        ->with('units',$units)
        ->with('owner',$owner)
        ->with('wishlists',$wishlists);

        
    }
}
