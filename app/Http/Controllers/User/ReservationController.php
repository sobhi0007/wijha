<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

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

        return view('profile.reservation_details')->with(['booking'=>$booking]);

    }

}
