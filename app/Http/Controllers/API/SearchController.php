<?php

namespace App\Http\Controllers\API;

use App\Models\City;
use App\Models\Unit;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\UnitResource;
use App\Http\Requests\API\CreatCityRequest;
use App\Http\Requests\API\UpdateCityRequest;
use App\Http\Requests\API\SearchWithDateRequest;

class SearchController extends Controller
{

  use APIResponse;

  public function searchForCityWithDate(SearchWithDateRequest $request)
  {
    $city = City::where('slug', $request->city)->first();
    if (!$city) return $this->APIResponse(null, null, 404, false,   'City not found .');

    // $units = Unit::where('city_id', '=', $city->id)
    //   ->whereNotIn('id', function ($query) use ($request) {
    //     $query->select('unit_id')
    //       ->from('bookings')
    //       ->where('to_datetime', '>=', $request->check_in);
    //   });




$units = Unit::where('city_id', '=', $city->id)
  ->whereNotIn('id', function ($query) use ($request) {
    $query->select('unit_id')
      ->from('bookings')
      ->where(function ($query) use ($request) {
        $query->where(function ($query) use ($request) {
          $query->where('from_datetime', '>=', $request->check_in)
            ->where('from_datetime', '<', $request->check_out);
        })
        ->orWhere(function ($query) use ($request) {
          $query->where('to_datetime', '>', $request->check_in)
            ->where('to_datetime', '<=', $request->check_out);
        })
        ->orWhere(function ($query) use ($request) {
          $query->where('from_datetime', '<', $request->check_in)
            ->where('to_datetime', '>', $request->check_out);
        });
      });
  })
  ;



    $query =  $units;

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

    if ($request->has('bathrooms')) {
      $query->where('bathrooms_number', $request->bathrooms);
    }

    if ($request->has('bedrooms')) {
      $query->where('bedrooms_number', $request->bedrooms);
    }

    if ($request->has('size_from') && $request->has('size_to') ) {
       $query->whereBetween('size', [$request->size_from,$request->size_to]);
    }
    if ($request->has('price_from') && $request->has('price_to') ) {
       $query->whereBetween('price', [$request->price_from,$request->price_to]);
    }


    $units = $query->where('status', 1)->where('activation', 1)->get();



    if ($units->count() > 0) {
      foreach ($units as $unit) {
        $images = $unit->getMedia('images');
        $data = [];
        foreach ($images as $image) {
          $data[] =   $image->getUrl();
        }
        $unit['images'] = $data;
      }
    }

    return $this->APIResponse(UnitResource::collection($units), null, 200, true,   'Data returned successfully');
  }
}
