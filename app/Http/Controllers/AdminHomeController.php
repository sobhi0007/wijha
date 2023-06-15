<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $bookings = $this->bookings();
        $units = $this->units();
        $payments = $this->payments();
        return view('dashboard.home', get_defined_vars());
    }

    public function bookings()
    {
        return Booking::latest()->take(10)->get();
    }

    public function units()
    {
        return Unit::latest()->take(10)->get();
    }

    public function payments()
    {
        return Payment::latest()->take(10)->get();
    }
}
