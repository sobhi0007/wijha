<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Type;
use App\Models\Unit;
use App\Models\Badge;
use App\Models\Person;
use Livewire\Component;
use App\Models\Capacity;
use App\Models\Category;
use App\Enums\UnitStatus;
use App\Enums\UnitActivation;

class SearchResult extends Component
{
    public $check_in;
    public $check_out;
    public $location;
    public $search;
    public $bedrooms;
    public $type;
    public $badge;
    public $category;
    public $capacity;
    public $person;

    protected $queryString = ['bedrooms','type','badge','category','capacity', 'person'];

    public function refresh()
    {
        $params = [
        'check_out'=> $this->check_out,
        'check_in'=> $this->check_in,
        'location'=> $this->location,
        'bedrooms'=>$this->bedrooms,
        'type'=>$this->type,
        'badge'=>$this->badge,
        'category'=>$this->category,
        'capacity'=>$this->capacity,
        'person'=>$this->person,
        ];
        $queryString = http_build_query($params);
        return redirect('/searchresults?'.$queryString);
    }
    
     public function resetAll()
    {
       
        $this->bedrooms=null;
        $this->type=null;
        $this->badge=null;
        $this->category=null;
        $this->capacity=null;
        $this->person=null;
        
        $params = [
        'check_out'=> $this->check_out,
        'check_in'=> $this->check_in,
        'location'=> $this->location,
        ];
        $queryString = http_build_query($params);
        return redirect('/searchresults?'.$queryString);
    }

    public function mount($check_in, $check_out, $location)
    {
        $this->check_in = $check_in;
        $this->check_out = $check_out;
        $this->location = $location;
    }
    
    public function render()
    {

        // dd($this->bedrooms);
        $lang = app()->getLocale();
        $city = City::search()->where('slug', $this->location)->get()->first();

        $search = $city ?   $lang == 'ar' ? $city->name_ar : $city->name_en : $this->location;

        $check_in = $this->check_in;
        $check_out = $this->check_out;
        $location = $this->location;
        $this->search = $search;
        $units = Unit::where('city_id', '=', $city->id)
            ->where('status', '=', UnitStatus::PUBLISHED->value)
            ->where('activation', '=', UnitActivation::ACTIVE->value)
            ->when($check_in && $check_out, function ($query) use ($check_in, $check_out) {

                $query->whereNotIn('id', function ($query) use ($check_in,  $check_out) {
                    $query->select('unit_id')
                        ->from('bookings')
                        ->where(function ($query) use ($check_in,  $check_out) {
                            $query->where(function ($query) use ($check_in,  $check_out) {
                                $query->where('from_datetime', '>=', $check_in)
                                    ->where('from_datetime', '<', $check_out);
                            })
                                ->orWhere(function ($query) use ($check_in,  $check_out) {
                                    $query->where('to_datetime', '>', $check_in)
                                        ->where('to_datetime', '<=', $check_out);
                                })
                                ->orWhere(function ($query) use ($check_in,  $check_out) {
                                    $query->where('from_datetime', '<', $check_in)
                                        ->where('to_datetime', '>', $check_out);
                                });
                        });
                });
            });
          

            $query =  $units;
            if ($this->capacity) {
                $query->where('capacity_id', $this->capacity);
              }
          
              if ($this->type !=null) {
                $query->where('type_id', $this->type);
              }
          
              if ($this->category) {
                $query->where('category_id', $this->category);
              }
          
              if ($this->badge) {
                $query->where('badge_id', $this->badge);
              }
          
              if ($this->person) {
                $query->where('person_id', $this->person);
              }
          
              if ($this->bedrooms != null) {
                $query->where('bedrooms_number', $this->bedrooms);
              }
          
            //   if ($this->size_from') && $this->size_to') ) {
            //      $query->whereBetween('size', [$request->size_from,$request->size_to]);
            //   }
        $units = $query->where('status', 1)->where('activation', 1)->paginate();

        foreach ($units as $key => $unit) {
            $images = $unit->getMedia('images');
            $x = [];
            foreach ($images as $image) {
                $x[] = $image->getUrl('responsive');
            }
            $unit['image'] = $x;
        }

        foreach ($units as $key => $unit) {
            $x = '<div class="card border-0" style="width: 18rem;">' .
                '<div id="carouselExampleIndicatorsss" class="carousel slide" data-bs-ride="carousel">' .
                '<div class="carousel-indicators">';
            $img_num = 0;
            foreach ($unit->image as $image) {
                $x .= '<button type="button" data-bs-target="#carouselExampleIndicatorsss" data-bs-slide-to="' . $img_num . '" class="';
                $x .= $img_num == 0 ? 'active" aria-current="true" ' : '';

                $x .= '" aria-label="Slide ' . $img_num . '"></button>';
                $img_num++;
            }
            $x .= '</div>' .
                '<div class="carousel-inner " style="width:100%; height: 200px !important;">';
            $img_num = 0;
            foreach ($unit->image as $image) {
                $x .=   '<div class="carousel-item  ';
                $x .= $img_num == 0 ? ' active' : '';
                $x .= '" >
                     <img src="' . $image . '" class="d-block w-100" alt="..." >' .
                    '</div>';
                $img_num++;
            }
            $x .=  '</div>' .
                '<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicatorsss" data-bs-slide="prev">' .
                '<span class="carousel-control-prev-icon" aria-hidden="true"></span>' .
                '<span class="visually-hidden">Previous</span>' .
                '</button>' .
                '<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicatorsss" data-bs-slide="next">' .
                '<span class="carousel-control-next-icon" aria-hidden="true"></span>' .
                '<span class="visually-hidden">Next</span>' .
                '</button>' .
                '</div>' .
                '<div class="px-3">' .

                '<div class="my-2 h6">' .

                '<span class="fw-bold">' . $unit->title . '</span>' .
                '</div>' .
                '<div class="my-1">' .
                '<i class="fa-solid fa-location-dot main-color"></i> ' .
                '<span class="text-muted ms-2">Entire cabin in 1 Anzinger Court</span>' .
                '</div>' .
                '<hr class="w-25">' .
                '<div class="row ">' .
                '<div class="col-6"><span class="fw-bold h6 text-main">' .  $unit->price . ' ' . __('lang.currency') . ' </span></div>' .
                '<div class="col-6 d-flex justify-content-end"> <span class="fw-bold h6"><i class="fa-solid fa-star text-warning "></i> 48 </span> <span class="text-muted ms-1 h6"> (28)</span> </div>' .
                '</div>' .
                '</div>' .
                '</div>';
            $unit['html'] = $x;
            $x = $unit['coordinates'];
            $x =  json_decode($x, true);
            $unit['lat'] = $x['lat'];
            $unit['long'] = $x['long'];
        }





        $badges =  Badge::all();
        $categories =  Category::all();
        $persons =  Person::all();
        $capacities =  Capacity::all();
        $types =  Type::all();





        return view('livewire.search-result', [
            'units' => $units,
            'types' => $types,
            'badges' => $badges,
            'persons'=>$persons,
            'capacities'=>$capacities,
            'categories'=>$categories, 
        ]);
    }

    public function updatedBedrooms($value)
    {
        // redirect(request()->header('Referer'));
        $this->emit('bedroomUpdated');
    }
}
