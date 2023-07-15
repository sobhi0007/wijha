<?php

namespace App\Http\Resources\Owner;

use App\Enums\BookingStatus;
use App\Http\Resources\Owner\UnitResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'reference_number' => $this->reference_number,
            'from' => $this->from_datetime,
            'to' => $this->to_datetime,
            'status' => $this->status->lang(),
            'original_price' => $this->original_price . ' ' . __('lang.currency'),
            'vat' => $this->vat . ' ' . __('lang.currency'),
            'total_price' => $this->total_price . ' ' . __('lang.currency'),
            'unit' => new UnitResource($this->unit),
            'image' => $this->unit->getFirstMediaURL('images'),
            'review' => new ReviewResource($this->review),
        ];
    }
}
