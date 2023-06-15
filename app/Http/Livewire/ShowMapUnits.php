<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Unit;
use App\Models\city;
// use Illuminate\Http\Request;
use  App\Http\Requests\Home\SearchRequest;
class ShowMapUnits extends Component
{
    
    public $location;
    public $t_start;
    public function mount($request)
    {
        $this->location = $request->location;
        $this->location = $request->t_start;
    }
    public function render()
    {

     
      $start_date = date('Y-m-d') ;

        $lang =app()->getLocale();
        $city = City::search($this->location)->get()->first();
        $search = $city ?   $lang == 'ar'? $city->name_ar:$city->name_en:$this->location;
        $id = empty($city)?3:$city->id;
        $units = Unit::where('city_id',$id)->where('status',1)->whereDoesntHave('bookings' , function ($query  ) use ( $start_date){
            $query->where('to_datetime','>=' ,$this->t_start);
        })->paginate(1);

        foreach ($units as $key => $unit) {
                $images=$unit->getMedia('images');
                $x=[];
                foreach ($images as $image) {
                    $x[] = $image->getUrl('responsive');
                }
                $unit['image'] =$x;
      
            }


          
      
        foreach ($units as $key => $unit) {
            $x= '<div class="card border-0" style="width: 18rem;">'.
            '<div id="carouselExampleIndicatorsss" class="carousel slide" data-bs-ride="carousel">'.
            '<div class="carousel-indicators">';
            $img_num=0;
                foreach ($unit->image as $image) {
                    $x.='<button type="button" data-bs-target="#carouselExampleIndicatorsss" data-bs-slide-to="'. $img_num.'" class="';
                    $x.= $img_num == 0 ?'active" aria-current="true" ':'';
                    
                    $x.= '" aria-label="Slide '. $img_num.'"></button>';
                    $img_num++;
                }
            $x.='</div>'.
            '<div class="carousel-inner " style="width:100%; height: 200px !important;">';
            $img_num=0;
                foreach ($unit->image as $image) {
                $x.=   '<div class="carousel-item  ';
                $x.= $img_num==0?' active':'';
                $x.='" >
                    <img src="'.$image.'" class="d-block w-100" alt="..." >'.
                    '</div>';
                    $img_num++;
                }
            $x.=  '</div>'.
            '<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicatorsss" data-bs-slide="prev">'.
            '<span class="carousel-control-prev-icon" aria-hidden="true"></span>'.
            '<span class="visually-hidden">Previous</span>'.
            '</button>'.
            '<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicatorsss" data-bs-slide="next">'.
            '<span class="carousel-control-next-icon" aria-hidden="true"></span>'.
            '<span class="visually-hidden">Next</span>'.
            '</button>'.
            '</div>'.
            '<div class="px-3">'.
            
            '<div class="my-2 h6">'.

            '<span class="fw-bold">'.$unit->title.'</span>'.
            '</div>'.
            '<div class="my-1">'.
            '<i class="fa-solid fa-location-dot main-color"></i> '.
            '<span class="text-muted ms-2">Entire cabin in 1 Anzinger Court</span>'.
            '</div>'.
            '<hr class="w-25">'.
            '<div class="row ">'.
            '<div class="col-6"><span class="fw-bold h6 text-main">'.  $unit->price.' '.__('lang.currency').' </span></div>'.
            '<div class="col-6 d-flex justify-content-end"> <span class="fw-bold h6"><i class="fa-solid fa-star text-warning "></i> 48 </span> <span class="text-muted ms-1 h6"> (28)</span> </div>'.
            '</div>'.
            '</div>'.
            '</div>';
            $unit['html']= $x;
            $x= $unit['coordinates'];
            $x=  json_decode($x,true);
            $unit['lat']= $x['lat'];
            $unit['long']= $x['long'];

    
        }
    
    
        $categories = Category::get(['name_'.app()->getLocale() .' as name', 'slug']);
   

        return view('livewire.show-map-units') 
        ->with('categories',$categories)
        ->with('units',$units)
        ->with('search', $search);
    }
}
