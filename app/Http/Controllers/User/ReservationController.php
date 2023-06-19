<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = auth()->user()->bookings()->with('unit')->latest()->paginate();
        $wishlists = auth()->user()->wishlist()->pluck('unit_id')->toArray();
        return view('profile.reservations',['bookings'=>$bookings,'wishlists'=>$wishlists]);
    }

}
