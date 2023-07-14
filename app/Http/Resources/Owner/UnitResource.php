<?php

namespace App\Http\Resources\Owner;

use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        if ($this->city) {
            $cityName = app()->getLocale() == 'ar' ? $this->city->name_ar : $this->city->name_en;
        } else {
            $cityName = null;
        }

        if ($this->district) {
            $districtName = app()->getLocale() == 'ar' ? $this->district->name_ar : $this->district->name_en;
        } else {
            $districtName = null;
        }

        if ($this->category) {
            $categoryName = app()->getLocale() == 'ar' ? $this->category->name_ar : $this->category->name_en;
        } else {
            $categoryName = null;
        }

        if ($this->type) {
            $typeName = app()->getLocale() == 'ar' ? $this->type->name_ar : $this->type->name_en;
        } else {
            $typeName = null;
        }

        if ($this->capacity) {
            $capacityName = app()->getLocale() == 'ar' ? $this->capacity->name_ar : $this->capacity->name_en;
        } else {
            $capacityName = null;
        }

        if ($this->badge) {
            $badgeName = app()->getLocale() == 'ar' ? $this->badge->name_ar : $this->badge->name_en;
        } else {
            $badgeName = null;
        }

        if ($this->person) {
            $personName = app()->getLocale() == 'ar' ? $this->person->name_ar : $this->person->name_en;
        } else {
            $personName = null;
        }

        if (count($this->getMedia('images'))) {
            $images = [];
            foreach ($this->getMedia('images') as $media) {
                array_push($images, $media->getUrl());
            }
        } else {
            $images = null;
        }


        return [
            'code' => $this->code,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'coordinates' => $this->coordinates,
            'city' => $cityName,
            'owner' => $this->owner,
            'district' => $districtName,
            'category' => $categoryName,
            'type' => $typeName,
            'size' => $this->size,
            'bathrooms_number' => $this->bedrooms_number,
            'bedrooms_number' => $this->bathrooms_number,
            'capacity' => $capacityName,
            'badge' => $badgeName,
            'person' => $personName,
            'images' => $images,
        ];
    }
}
