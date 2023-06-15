<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Unit;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UnitResource;
use App\Http\Resources\CityResource;
use App\Http\Resources\TypeResource;
use App\Http\Resources\CapacityResource;
use App\Http\Resources\BadgeResource;
use App\Http\Resources\PersonResource;
use App\Http\Resources\DistrictResource;
use App\Http\Requests\API\CreatCityRequest;
use App\Http\Requests\API\UpdateCityRequest;

class DistrictController extends Controller{
  
  use APIResponse ;
   
  // public function AllCategories()
  // {
  //   $category = category::all();
  //   if($category->isNotEmpty()){
  //     return $this->APIResponse(CategoryResource::collection($category)  , 200  , true );
  //   }else{
  //     return $this->APIResponse(null , 404 , true ,   'No recordes found .') ;
  //   }
  // }

  public function ShowUnitsRelated($district)
  {
   
    $district = District::where('slug' , '=' , $district )->first() ;
    if(!$district) return $this->APIResponse(null , null ,404 , false ,'District not found');

   
    $units = $district->units;
    if(!$units->isNotEmpty()) return $this->APIResponse(null , null ,404 , false ,'No Records Found');

    foreach($units as $unit){

    $media = $unit->getMedia('images');

    $all_images[]=[];
    foreach ($media as $key=>$img ) {
      $all_images[$key][]=$media[$key]['original_url'];
    } 

    $unit['images'] = $all_images;

      $unit['owner'] = new  UserResource($unit->user);
      $unit['city'] =new CityResource($unit->city);
      $unit['district'] =new DistrictResource($unit->district);
      $unit['category'] =new CategoryResource($unit->category); 
      $unit['type'] =new TypeResource($unit->type); 
      $unit['capacity'] =new CapacityResource($unit->capacity); 
      $unit['badge'] =new BadgeResource($unit->badge); 
      $unit['person'] =new PersonResource($unit->person); 
    }
     return $this->APIResponse(UnitResource::collection($units), 200 , true);

  }



  public function AllDistricts()
  {
    $districts = District::with('city')->get();
   
     foreach ($districts as $district) {
     $district['city'] = new CityResource($district->city);
     }

      return  DistrictResource::collection($districts);
   
  }

}
