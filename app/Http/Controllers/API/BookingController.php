<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Unit;
use App\Models\Booking;
use App\Models\Category;
use App\Enums\BookingStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\UnitResource;
use App\Http\Resources\BookingResource;
use Laravel\Sanctum\PersonalAccessToken;


class BookingController extends Controller
{

  use APIResponse;
  public function booking(Request $request)
  {
    $unit =  Unit::where('code', $request->code)->where('status', 1)->first();

    if (!$unit) return $this->APIResponse(null, null, 404, true,   'Unit is not found .');

    $unitIsNotAvailable = Booking::where('unit_id', '=', $unit->id)
      ->where(function ($query) use ($request) {
        $query->where(function ($query) use ($request) {
          $query->where('from_datetime', '>=', $request->check_in)
            ->where('from_datetime', '<', $request->check_out);
        })
          ->orWhere(function ($query)  use ($request) {
            $query->where('to_datetime', '>', $request->check_in)
              ->where('to_datetime', '<=', $request->check_out);
          })
          ->orWhere(function ($query) use ($request) {
            $query->where('from_datetime', '<', $request->check_in)
              ->where('to_datetime', '>', $request->check_out);
          });
      })
      ->count();

    if ($unitIsNotAvailable) {
      return $this->APIResponse(null, null, 200, true,   'Unit is not available .');
    } else {
      $check_in = Carbon::parse($request->check_in);
      $check_out = Carbon::parse($request->check_out);
      $days = $check_out->diffInDays($check_in);
      $price_per_day = $unit->price;
      $service_price = 0;
      $total_price = ($unit->price + 0) * $days;
      $check_in = $request->check_in;
      $check_out = $request->check_out;
      $unit_code =  $unit->code;
      return $this->APIResponse(
        compact('unit_code', 'check_in', 'check_out', 'days', 'price_per_day', 'service_price', 'total_price'),
        null,
        200,
        true,
        'Unit is  available .'
      );
    }
  }


  public function history(Request $request)
  {
    $bearerToken = $request->token;
    $token = PersonalAccessToken::findToken($bearerToken);
    if (!$token) {
        return $this->APIResponse(null , null , 404 , false ,'Token not found');
    }
    $user = $token->tokenable;
    $bookings = $user->bookings()->with('unit')->get();

    return $this->APIResponse(
      BookingResource::collection($bookings),
       null,
      200,
      true,
      'All booked units that belongs to user .'
    );

}
}
