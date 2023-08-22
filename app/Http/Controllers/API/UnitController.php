<?php

namespace App\Http\Controllers\API;
use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\City;
use App\Models\Unit;
use App\Models\Booking;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\UnitResource;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller{
  
  use APIResponse ;


  public function featuredUnits(){
    $units = Unit::where('badge_id','!=', null)->get();


    if ($units->count() > 0) {
      foreach ($units as $unit) {
         $images = $unit->getMedia('images');
         $data=[];
          foreach($images as $image){
         $data[] =   $image->getUrl();
        }
        $unit['images'] = $data; 
      }
  
    
      return $this->APIResponse( UnitResource::collection($units) , null ,   200  , true  , 'All featured units');
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
  
    public function units(Request $request){

      
        $query = Unit::query();

        if ($request->has('capacity_id')) {
            $query->where('capacity_id', $request->input('capacity_id'));
        }

        if ($request->has('unit_type_id')) {
            $query->where('type_id', $request->input('unit_type_id'));
        }

        if ($request->has('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->has('badge_id')) {
            $query->where('badge_id', $request->input('badge_id'));
        }

        if ($request->has('person_id')) {
            $query->where('person_id', $request->input('person_id'));
        }

        if ($request->has('price_from')) {
          $query->whereBetween('price', [$request->price_from ,$request->price_to ]);
      }


        $units = $query->where('status',1)->where('activation',1)->get();
        if ($units->count() > 0) {
          foreach ($units as $unit) {
            $images = $unit->getMedia('images');
            $data=[];
              foreach($images as $image){
            $data[] =   $image->getUrl();
            }
            $unit['images'] = $data; 
          }
          return $this->APIResponse( UnitResource::collection($units) , null ,   200  , true  , null);
        }else{
          return $this->APIResponse(null , null, 200 , false ,   'No data found .') ;
        }
    }

    public function getBookedUnitDates($code)
    {
      $unit =  Unit::where('code', $code)->where('status', 1)->first();
      if (!$unit) return $this->APIResponse(null, null, 404, true,   'Unit is not found .');
      $bookedDates = Booking::where('unit_id',$unit->id)->get(['from_datetime','to_datetime']);
      

      $dateRanges = $bookedDates->flatMap(function ($booking) {
      $from = new DateTime(max($booking->from_datetime, date('Y-m-d')));
      $to = new DateTime($booking->to_datetime);
      $dates = [];
  
      $period = new DatePeriod(
          $from,
          new DateInterval('P1D'),
          $to->modify('+1 day')
      );
  
      foreach ($period as $date) {
          $dates[] = $date->format('Y-m-d');
      }
  
      return $dates;
  })->unique()->values()->toArray();
  
  usort($dateRanges, function($a, $b) {
      $dateA = new DateTime($a);
      $dateB = new DateTime($b);
      return $dateA <=> $dateB;
  });
  
 
  
      return $this->APIResponse($dateRanges , null ,   200  , true  , 'Booked unit dates .');
    }
  
  
  
  public function GetUnitsBelongsToCityName(Request $request){
      
    $city = City::where('name_en', 'like', '%' . $request->city . '%')->with('units')->get();
    if($city->count() > 0 ){
    foreach ($city as $cityItem) {
        // Access the units associated with the city
        $units = $cityItem->units;
    
        // Iterate over the units
        foreach ($units as $unit) {
          // Access unit properties
          $images = $unit->getMedia('images');
          $imageUrls = [];
  
          foreach ($images as $image) {
              // Get the URL of each image
              $imageUrl = $image->getUrl();
  
              // Store the URL in an array
              $imageUrls[] = $imageUrl;
          }
  
          // Assign the image URLs to the unit
         
            // Assign the image URLs to the unit
        $unit->images = $imageUrls;
        
        // Remove the media object from the unit
        unset($unit->media);
      }
    }

    return $this->APIResponse($city , null ,   200  , true  , 'Units that belongs to city.');
  }else{
    return $this->APIResponse(null , null, 204 , true ,   'No data found .') ;
  }
 
    }
    
    
    public function findUnitsByCoordinates(Request $request){
      
    $lat = $request->lat;
    $long = $request->long;
    $radius = $request->radius;

    $units = Unit::select('*')
    ->whereRaw('(6371 * 
        ACOS(
            COS(RADIANS(90 - ?)) * 
            COS(RADIANS(90 - JSON_UNQUOTE(JSON_EXTRACT(coordinates, "$.lat")))) * 
            COS(RADIANS(? - JSON_UNQUOTE(JSON_EXTRACT(coordinates, "$.long")))) + 
            SIN(RADIANS(90 - ?)) * 
            SIN(RADIANS(90 - JSON_UNQUOTE(JSON_EXTRACT(coordinates, "$.lat"))))
        )) <= ?', [$lat, $long, $lat, $radius])
    ->get();



      if ($units->count() > 0) {
        foreach ($units as $unit) {
        $images = $unit->getMedia('images');
        $data=[];
        foreach($images as $image){
        $data[] =   $image->getUrl();
        }
        $unit['images'] = $data; 
        }
        return $this->APIResponse( UnitResource::collection($units) , null ,   200  , true  , 'All units belongs to coordinates');
      }else{
        return $this->APIResponse(null , null, 404 , true ,   'No data found .') ;
      }


    }

}
