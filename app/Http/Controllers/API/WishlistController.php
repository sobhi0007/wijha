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

class WishlistController extends Controller{
  
  use APIResponse ;

  public function belongsToUser(Request $request)
  {
          $bearerToken = $request->token;
          $token = PersonalAccessToken::findToken($bearerToken);
          if (!$token) {
              return $this->APIResponse(null , null , 422  , false ,'Token not found');
          }

          $ids=[];
          foreach ($token->tokenable->wishlist as $wishlist) {
            $ids[] = $wishlist->unit_id; 
          }

          $units = Unit::whereIn('id', $ids)->get();
          if ($units->count() > 0) {
            foreach ($units as $unit) {
               $images = $unit->getMedia('images');
               $data=[];
                foreach($images as $image){
               $data[] =   $image->getUrl();
              }
              $unit['images'] = $data; 
            }
          }
          return $this->APIResponse( UnitResource::collection($units)  , null , 200 , true ,'User\'s wishlist');
  
}
 
  public function addUnit(Request $request)
  {
          $bearerToken = $request->token;
          $token = PersonalAccessToken::findToken($bearerToken);
          if (!$token)
          return $this->APIResponse(null , null , 404 , false ,'Token not found');

          $unit = Unit::where('code',$request->unit_code)->first();

          if(!$unit)
          return $this->APIResponse(null , null , 404 , false ,'Unit not found');

          $hasUnit = User::where('id', $token->tokenable->id)
          ->whereHas('wishlist', function ($query) use ($unit) {
              $query->where('unit_id', $unit['id']);
          })
          ->exists();
          
          if($hasUnit)
          return $this->APIResponse(null , null , 404 , false ,'Unit is already exists in wishlist');
        
            Wishlist::create([
            'user_id'=>$token->tokenable->id,
            'unit_id'=>Unit::where('code',$request->unit_code)->first()->id
          ]);
          return $this->APIResponse( null, null , 200 , true ,'Unit added to wishlist successfully .');
  }
 

  public function removeUnit(Request $request)
  {
          $bearerToken = $request->token;
          $token = PersonalAccessToken::findToken($bearerToken);
          if (!$token)
          return $this->APIResponse(null , null , 422  , false ,'Token not found');

           $unit = Unit::where('code',$request->unit_code)->first();

          if(!$unit)
          return $this->APIResponse(null , null , 422  , false ,'Unit not found');

          $hasUnit = User::where('id', $token->tokenable->id)
          ->whereHas('wishlist', function ($query) use ($unit) {
              $query->where('unit_id', $unit['id']);
          });
          
          if(!$hasUnit->exists())
          return $this->APIResponse(null , null , 422  , false ,'User didn\'t add this unit in wishlist');

          Wishlist::where('user_id',$token->tokenable->id)->where('unit_id',$unit['id'])->delete();

          return $this->APIResponse( null, null , 200 , true ,'Unit removed from wishlist successfully .');
  }
 
}
