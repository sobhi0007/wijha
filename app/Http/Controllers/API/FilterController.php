<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Badge;
use App\Models\Category;
use App\Models\Person;
use App\Models\Capacity;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Resources\BadgeResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PersonResource;
use App\Http\Resources\CapacityResource;
use App\Http\Resources\TypeResource;


class FilterController extends Controller{
  
  use APIResponse ;
  public function filters()
  {
        $badges =  Badge::all();
        $categories =  Category::all();
        $persons =  Person::all();
        $capacities =  Capacity::all();
        $types =  Type::all();

        $data = [
          'badges' => BadgeResource::collection($badges),
          'categories'=> CategoryResource::collection($categories),
          'persons'=>PersonResource::collection($persons),
          'capacities'=>CapacityResource::collection($capacities),
          'types'=> TypeResource::collection($types),
          'bathrooms'=> 10 ,
          'bedrooms'=>  20,

        ];


        return $this->APIResponse($data , null , 200 , true ,   'Filters returned successfully') ; 
    
  }  
 

}
