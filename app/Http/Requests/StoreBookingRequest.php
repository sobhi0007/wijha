<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->route()->booking->id ?? null;
        return [
            'reference_number' => 'required',
            'from_datetime'    => 'required|date',
            'to_datetime'      => 'required|date|after:from_datetime',
            'original_price'   => 'required|numeric|min:0',
            'vat'              => 'nullable|numeric|min:0',
            'total_price'      => 'required|numeric|min:0',
            'status'           => 'required',
            'user_name'        => 'required',
            'unit_id'          => 'required',
            'city_id'          => 'required',
            'phone'            => 'nullable',
            'email'            => 'nullable|email',
        ];
    }

    /**
     * Attributes .
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'reference_number' => __('lang.reference_number'),
            'from_datetime'    => __('lang.from_datetime'),
            'to_datetime'      => __('lang.to_datetime'),
            'original_price'   => __('lang.original_price'),
            'vat'              => __('lang.vat'),
            'total_price'      => __('lang.total_price'),
            'status'           => __('lang.status'),
            'user_name'        => __('lang.user'),
            'unit_id'          => __('lang.unit'),
            'city_id'          => __('lang.city'),
            'phone'            => __('lang.phone'),
            'email'            => __('lang.email'),
        ];
    }
}
