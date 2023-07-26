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
    return $this->APIResponse( $token->tokenable->unreadNotifications, null, 200, true, 'Unread Notifications');
  }

  public function markAllAsRead(Request $request){
    $bearerToken = $request->token;
    $token = PersonalAccessToken::findToken($bearerToken);
    if (!$token) {
      return $this->APIResponse(null, null, 422, false, 'Token not found');
    }
    $token->tokenable->unreadNotifications->markAsRead();
    return $this->APIResponse( null, null, 200, true, 'All notifications marked as read');
  }
  
  public function markAsRead(Request $request){
    $bearerToken = $request->token;
    $token = PersonalAccessToken::findToken($bearerToken);
    if (!$token) {
      return $this->APIResponse(null, null, 422, false, 'Token not found');
    }

    $notification = $token->tokenable->unreadNotifications()->find($request->id);

    if (!$notification) {
      return $this->APIResponse( null, null, 404, true, 'Notification not found');
    }

    $notification->markAsRead();

    return $this->APIResponse( null, null, 200, true, 'Notification marked as read');
  }


}
