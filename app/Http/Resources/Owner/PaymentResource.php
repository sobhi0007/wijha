<?php

namespace App\Http\Resources\Owner;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'id' => $this->id,
            'booking' => $this->booking?->reference_number,
            'payment_method' => $this->payment_method,
            'amount' => $this->amount,
            'status' => $this->status?->lang(),
        ];
    }
}
