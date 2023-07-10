<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
  public function markAsRead(){
    
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
  }
}
