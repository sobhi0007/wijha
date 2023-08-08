<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
{
    $cityName = $this->city ? ('name_'.app()->getLocale() == 'name_ar') ? $this->city->name_ar : $this->city->name_en : null;
    $districtName = $this->district ? ('name_'.app()->getLocale() == 'name_ar') ? $this->district->name_ar : $this->district->name_en : null;
    $categoryName = $this->category ? ('name_'.app()->getLocale() == 'name_ar') ? $this->category->name_ar : $this->category->name_en : null;
    $typeName = $this->type ? ('name_'.app()->getLocale() == 'name_ar') ? $this->type->name_ar : $this->type->name_en : null;
    $capacityName = $this->capacity ? ('name_'.app()->getLocale() == 'name_ar') ? $this->capacity->name_ar : $this->capacity->name_en : null;
    $badgeName = $this->badge ? ('name_'.app()->getLocale() == 'name_ar') ? $this->badge->name_ar : $this->badge->name_en : null;
    $personName = $this->person ? ('name_'.app()->getLocale() == 'name_ar') ? $this->person->name_ar : $this->person->name_en : null;
    $owner = $this->user;
    return [
        'code' => $this->code,
        'title' => $this->title,
        'description' => $this->description,
        'price' => $this->price,
        'coordinates' => $this->coordinates,
        'city' => $cityName,
        'owner' => $owner,
        'district' => $districtName,
        'category' => $categoryName,
        'type' => $typeName,
        'size' => $this->size,
        'bathrooms_number' => $this->bedrooms_number,
        'bedrooms_number' => $this->bathrooms_number,
        'capacity' => $capacityName,
        'badge' => $badgeName,
        'person' => $personName,
        'images' => $this->images
    ];
}
}
