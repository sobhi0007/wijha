<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Unit;
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

class CategoryController extends Controller{
  
  use APIResponse ;
   
  public function AllCategories()
  {
    $category = Category::all();
    if($category->isNotEmpty()){
      return $this->APIResponse(CategoryResource::collection($category) , null , 200  , true , NULL );
    }else{
      return $this->APIResponse(null , null ,  404 , true ,   'No recordes found .') ;
    }
  }

  public function ShowUnitsRelated($category)
  {
   
    $category = Category::where('slug' , 'like' , '%'.$category.'%' )->first() ;
    if(!$category) return $this->APIResponse(null , null , 404 , false ,'Category not found');

   
    $units = $category->units;
    if(!$units->isNotEmpty()) return $this->APIResponse(null , null ,404 , false ,'No Records Found');

    foreach($units as $unit){
      $unit['owner'] = new  UserResource($unit->user);
      $unit['city'] =new CityResource($unit->city);
      $unit['district'] =new DistrictResource($unit->district);
      $unit['category'] =new CategoryResource($unit->category); 
      $unit['type'] =new TypeResource($unit->type); 
      $unit['capacity'] =new CapacityResource($unit->capacity); 
      $unit['badge'] =new BadgeResource($unit->badge); 
      $unit['person'] =new PersonResource($unit->person); 
    }
     return $this->APIResponse(UnitResource::collection($units), null ,200 , true , null);

  }


}
