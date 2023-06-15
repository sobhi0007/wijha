<?php

namespace App\Http\Controllers\Owner;

use App\Models\Unit;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OwnerHomeController extends Controller
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
        return view('owner.home', get_defined_vars());
    }

    public function bookings()
    {
        return Booking::owner()->latest()->take(10)->get();
    }

    public function units()
    {
        return Unit::owner()->latest()->take(10)->get();
    }

    public function payments()
    {
        return Payment::owner()->latest()->take(10)->get();
    }
}
