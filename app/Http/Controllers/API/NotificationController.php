<?php

namespace App\Http\Controllers\API;

use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\City;
use App\Models\Unit;
use App\Models\User;
use App\Models\Booking;
use App\Models\District;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\UnitResource;
use Laravel\Sanctum\PersonalAccessToken;

class NotificationController extends Controller
{

  use APIResponse;

  public function belongsToUser(Request $request)
  {
    $bearerToken = $request->token;
    $token = PersonalAccessToken::findToken($bearerToken);
    if (!$token) {
      return $this->APIResponse(null, null, 422, false, 'Token not found');
    }

    return  auth()->user()->notifications;
    return $this->APIResponse(UnitResource::collection($units), null, 200, true, 'User\'s wishlist');
  }

}
