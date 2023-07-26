<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Unit;
use Livewire\Component;
use App\Enums\UnitStatus;
use App\Enums\UnitActivation;

class ShowUnits extends Component
{
public $cities;
public $btn='';
public $units;
public $wishlists='';


public function getCity($btn='')
{
     $this->btn = $btn;
     $city =  City::where('slug', $this->btn)->get()->first();
     $this->units = Unit::where('city_id',$city->id)->get();
     $units = $this->units;
     foreach ( $units as $key=>$unit) {
        // $this->units[$key]['img'] = $unit->getFirstMediaUrl('image', 'responsive') ;
        $units[$key]['img'] = $unit->id ;
    }
}
    public function render()
    { 
         $lang =app()->getLocale();
         $this->cities =  City::where('featured', 1)
         ->whereHas('units')
         ->get(['name_'.app()->getLocale().' as name' , 'slug']);
         if($this->btn == ''){
            $this->btn =  City::where('featured',1)->get('slug')->first()['slug'];
            $city =  City::where('slug', $this->btn)->get()->first();
            $this->units = Unit::where('city_id',$city->id) ->where('units.status', '=', UnitStatus::PUBLISHED->value)
            ->where('units.activation', '=', UnitActivation::ACTIVE->value) ->latest('created_at')->take(8)->get();
        }
        $units = $this->units;
        $num=0;
        foreach ( $units as $key=>$unit) {
           $images = $unit->getMedia('images');
           foreach ($images as $key=>$image ) {
            $x[]=$image->getUrl('responsive');
           }
           $this->units[$num]['img'] =$x;
           $x=[];
           $num++;
           
        }
        return view('livewire.show-units');
    }
}
