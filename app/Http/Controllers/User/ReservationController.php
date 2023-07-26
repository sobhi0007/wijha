<?php

namespace App\Http\Controllers\User;

use App\Models\Unit;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
   
    public function index()
    {
        $bookings = auth()->user()->bookings()->with('unit')->latest()->paginate();
        $wishlists = auth()->user()->wishlist()->pluck('unit_id')->toArray();
        return view('profile.reservations',['bookings'=>$bookings,'wishlists'=>$wishlists]);
    }



    public function reservationDetails(Booking $booking){
        auth()->user()->id === $booking->user_id ?:abort(404);
        $units =  Unit::where('id',$booking->unit_id)->get();

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

        return view('profile.reservation_details')->with(['booking'=>$booking]) ->with('units',$units);

    }

}
