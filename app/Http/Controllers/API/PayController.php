<?php

namespace App\Http\Controllers\API;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Unit;
use App\Models\Booking;
use App\Models\District;
use App\Enums\BookingStatus;
use Illuminate\Http\Request;
use App\Notifications\Reservation;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\UnitResource;
use Laravel\Sanctum\PersonalAccessToken;


class PayController extends Controller{
  
  use APIResponse ;


  public function availability($code , Request $request)
  {
        $unit=Unit::where('code',$code)->first();
       
        $check_in=$request->check_in;
        $check_out=$request->check_out;
        $check_in = Carbon::parse($check_in);
        $check_out = Carbon::parse($check_out);
        $days = $check_out->diffInDays($check_in);

        $unitIsNotAvailable = Booking::where('unit_id', $unit->id)
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
        return $this->APIResponse([
          'check_in'=>$request->check_in,
          'check_out'=>$request->check_out,
          'days'=>$days,
          'price_per_day'=>$unit->price,
          'vat'=>0,
          'total_price'=>($unit->price+0)*$days,
          
        ] , null ,   200  , true  , 'Unit is available .');
        }
  }
  
  
  public function store($code, Request $request)
  {

          if($request->payment_status =='fail' || $request->payment_status !='paid' )  return $this->APIResponse(null , null , 403  , false ,'Payment Failed');

          $bearerToken = $request->token;
          $token = PersonalAccessToken::findToken($bearerToken);
          if (!$token) return $this->APIResponse(null , null , 404 , false ,'Token not found');
        
          $user = $token->tokenable;


          $unit=Unit::where('code',$code)->first();
          $check_in=$request->check_in;
          $check_out=$request->check_out;
          $check_in = Carbon::parse($check_in);
          $check_out = Carbon::parse($check_out);
          $days = $check_out->diffInDays($check_in);
          
          if(($unit->price+0)*$days != $request->amount/100) return $this->APIResponse(null , null , 403  , false ,'Payment value error');
     

          
        $unitIsNotAvailable = Booking::where('unit_id', $unit->id)
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
          return $this->APIResponse(null, null, 404, false,   'Unit is not available .');
        } else {
          $check_in=$request->check_in;
          $check_out=$request->check_out;

          Booking::create([
            'reference_number' => $unit->code.'-'.time(),
            'from_datetime' => $check_in,
            'to_datetime' => $check_out,
            'original_price'=>$unit->price,
            'vat'=>0,
            'total_price'=>$request->amount/100,
            'status'=> BookingStatus::PENDING,
            'user_id'=>$user->id,
            'unit_id'=>$unit->id,
        ]);
    
           $user->notify( new Reservation($unit , $user , __('lang.booked_success_title'), __('lang.booked_success_body').' '.$unit->title.' '.__('lang.thanks')));
           return $this->APIResponse(null , null , 200 , true ,'Unit booked successfully. ');
        }
      }
}
