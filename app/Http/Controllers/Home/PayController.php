<?php

namespace App\Http\Controllers\Home;
use Carbon\Carbon;
use App\Models\Unit;
use ReflectionClass;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Category;
use App\Enums\BookingStatus;
use Illuminate\Http\Request;
use App\Notifications\Reservation;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;



class PayController extends Controller
{

    public function index()
    {
      return  view('home.pay');
    }

    public function store(Request $request)
    {
    
       $unit=Unit::where('code',Session::get('unit'))->first();
          $check_in=Session::get('check_in');
          $check_out=Session::get('check_out');
          $check_in = Carbon::parse($check_in);
          $check_out = Carbon::parse($check_out);
          $days = $check_out->diffInDays($check_in);
          
          // $reflection = new ReflectionClass('App\Enums\MoyasarPaymentStatus');
          if(
          $request->status == 'paid'
        
          && 
          $request->amount == ($unit->price+0)*$days*100
          ){
            $booking =  Booking::create([
          'reference_number' => $unit->code.'-'.time(),
          'from_datetime' => $check_in,
          'to_datetime' => $check_out,
          'original_price'=>$unit->price,
          'vat'=>0,
          'total_price'=>($unit->price+0)*$days,
          'status'=> BookingStatus::PENDING,
          'user_id'=>auth()->user()->id,
          'unit_id'=>$unit->id,
      ]);

          Payment::create([
          'booking_id' => $booking->id,
          'user_id' =>    auth()->user()->id,
          'payment_id' => $request->id,
          'payment_method'=>'credit-card',
          'amount'=>  $request->amount/100,
          'status'=> $request->status,
      ]);

      // $userSessionId = Session::getId();
      $this->sendFCMNotification( __('lang.booked_success_title'), __('lang.booked_success_body').' '.$unit->title.' '.__('lang.thanks'));
      auth()->user()->notify( new Reservation($unit , auth()->user() , __('lang.booked_success_title'), __('lang.booked_success_body').' '.$unit->title.' '.__('lang.thanks')));
     
      return redirect()->to(  URL::temporarySignedRoute(
        'home.paymentSuccess', now()->addMinutes(1))
    );
    }else{
      return redirect()->to(  URL::temporarySignedRoute(
        'home.paymentFail', now()->addMinutes(1))
    );
    }
    
  }



  protected function sendFCMNotification($title , $body)
  {
      $firebaseToken = array(auth()->user()->fcm_token) ;
        
      $SERVER_API_KEY = 'AAAAuU4C0eo:APA91bFzRVlCxfg_9X4D1kBNr6wqqdUmcQBRZMqoYXAzMjezGp8CZobqoMZj7X0fUzWzOB_GArT6IfnDcdvlpPDTbBRcsgL9nbEd8TcCvmOyiMXbKQSUBbMzKb-xD2BDH8EUVpk7BNHJ';

      $data = [
          "registration_ids" => $firebaseToken,
          "notification" => [
              "title" => $title,
              "body" => $body,  
          ]
      ];
      $dataString = json_encode($data);
  
      $headers = [
          'Authorization: key=' . $SERVER_API_KEY,
          'Content-Type: application/json',
      ];
  
      $ch = curl_init();
    
      curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
      $response = curl_exec($ch);
  

  }
}
