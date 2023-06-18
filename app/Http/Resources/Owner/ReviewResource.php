<?php

namespace App\Http\Resources\Owner;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'ID' => $this->id,
            'Booking' => $this->booking?->reference_number,
            'Accuracy' => $this->accuracy,
            'Cleanliness' => $this->cleanliness,
            'Services' => $this->services,
            'Location' => $this->location,
            'Overall Rating' => $this->overall_rating,
            'Review' => $this->review,
        ];
    }
}
