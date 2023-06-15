<?php

namespace App\Http\Controllers\Home;
use App\Models\City;

use App\Models\Slider;
use App\Models\Category;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $lang =app()->getLocale();
    
        $categories = Category::get(['name_'.app()->getLocale() .' as name', 'slug']);
        $sliders =  Slider::get(['id','text','link'] );
        $cities = City::where('featured','1')->withCount(['units' => function($query) {
            $query->where('status',1);
        }])->get(['id','name_'.app()->getLocale().' as name ', 'slug']);
       
       
        $all_cities =City::has('units')->get();
        foreach ($sliders as $key=>$slider) {
            $sliders[$key]['text']  = $slider->text;
            $sliders[$key]['img'] =  $slider->getFirstMediaUrl('image', 'responsive') ;
        }

        foreach ($cities as $key=>$city) {
            $cities[$key]['name']  = $lang=='en'? $city->name_en:$city->name_ar;
            $cities[$key]['img'] =  $city->getFirstMediaUrl('image', 'responsive') ;
            $cities[$key]['slug'] =   $city->slug;
            $cities[$key]['units_count'] =   $city->units_count;
        }

        return view('home.index')
        ->with('categories',$categories)
        ->with('sliders',$sliders)
        ->with('cities',$cities)
        ->with('all_cities',$all_cities);

    }
}
