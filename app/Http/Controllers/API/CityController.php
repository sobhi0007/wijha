<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Resources\CityResource;
use App\Http\Resources\DistrictResource;
use App\Http\Requests\API\CreatCityRequest;
use App\Http\Requests\API\UpdateCityRequest;

class CityController extends Controller{
  
  use APIResponse ;
   
  public function AllCities(){
    $city = City::all();
    if($city->isNotEmpty() ){
      foreach($city as $data){
        $data['image']= City::find($data->id)->getFirstMediaUrl('image');
      }
      return $this->APIResponse(CityResource::collection($city) , null ,   200  , true  , 'All Cities');
    }else{
      return $this->APIResponse(null , null, 204 , true ,   'No data found .') ;
    }
  }

  public function featuredCities(){
    $city = City::where('featured',1)->get();
    if($city->count() > 0 ){
      foreach($city as $data){
        $data['image']= City::find($data->id)->getFirstMediaUrl('image');
      }
      return $this->APIResponse(CityResource::collection($city) , null ,   200  , true  , 'All featured cities');
    }else{
      return $this->APIResponse(null , null, 204 , true ,   'No data found .') ;
    }
  }


  
  public function CityHasUnits(){
    $city = City::whereHas('units')->get();
    if($city->count() > 0 ){
      foreach($city as $data){
        $data['image']= City::find($data->id)->getFirstMediaUrl('image');
      }
      return $this->APIResponse(CityResource::collection($city) , null ,   200  , true  , 'Cities that have units .');
    }else{
      return $this->APIResponse(null , null, 204 , true ,   'No data found .') ;
    }
  }



  public function ShowCity($city)
  {
    $data = City::where('slug' , '=' , $city )->first() ;
    if($data){
      $data['image']= City::find($data->id)->getFirstMediaUrl('image');
      return $this->APIResponse(new CityResource($data), null , 200 , true,'City is exist.');
    }else{
      return $this->APIResponse(null ,null, 404 , false ,'City not found');
    }
  }


public function Showdistricts($city)
{
  $city = City::where('slug','=',$city)->first();
  if(!$city)  return $this->APIResponse(null , 404 , false ,'City not found');

  $districts =  District::where('city_id' , '=',$city->id)->whereHas('city')->get();

  if($districts){
    return $this->APIResponse( DistrictResource::collection($districts) ,null, 200 , true,'District Found .');
  }else{
    return $this->APIResponse(null , null , 404 , false ,'City not found');
  }
}





}
