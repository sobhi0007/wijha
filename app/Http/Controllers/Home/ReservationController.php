<?php

namespace App\Http\Controllers\Home;

use Carbon\Carbon;
use App\Models\Unit;
// use Illuminate\Http\Request;
use App\Models\Booking;

use App\Models\Category;
use App\Enums\BookingStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Home\ReservationFormRequest;

class ReservationController extends Controller
{
    public function index(ReservationFormRequest $request)
    {
        $unitId = $request->input('unit');
        $unit = Unit::where('code', $request->unit)->first();       
        $check_in = Carbon::parse($request->check_in);
        $check_out = Carbon::parse($request->check_out);
        $days = $check_out->diffInDays($check_in);
        $lang = app()->getLocale();
        $categories = Category::get(['name_' . $lang . ' as name', 'slug']);
        $total_price = ($unit->price+0)*$days;
        Session::put('unit', $unitId);
        Session::put('check_in', $request->check_in);
        Session::put('check_out', $request->check_out);
        Session::put('days',  $days);
        Session::put('total_price',  $total_price);
        if (!auth()->check()) {
            return redirect()->route('login');
        } else {
            return  view('home.pay', compact(['categories','unit','days','total_price','lang']));
        }
    }
}
