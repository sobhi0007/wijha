<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DistrictResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

      
        return [
            'name_'.app()->getLocale() => ('name_'.app()->getLocale() == 'name_ar')? $this->name_ar:$this->name_en,
            'slug' => $this->slug,
            'city'=> $this->when( $request->routeIs('districts'),function (){
                 return  $this->city;
            })

        ];
    }
}
