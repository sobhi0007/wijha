<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;

class OwnerStoreUnitRequest extends FormRequest
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
        $id = $this->route()->type->id ?? null;
        $rules = [
            'basic.category_id'          => 'required|exists:categories,id',
            'basic.city_id'              => 'required|exists:cities,id',
            'basic.district_id'          => 'required|exists:districts,id',
            'basic.size'                 => 'required|numeric',
            'basic.bathrooms_number'      => 'required|numeric',
            'basic.bedrooms_number'       => 'required|numeric',
            'basic.arrival_time'         => 'required',
            'basic.departure_time'       => 'required',
            'basic.price'                => 'required|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'basic.title'                => 'required',
            'basic.description'          => 'required',
            'basic.coordinates'          => 'nullable',
            'basic.type_id'              => 'nullable|exists:types,id',
            'basic.capacity_id'          => 'nullable|exists:capacities,id',
            'basic.person_id'            => 'nullable|exists:persons,id',
            'basic.badge_id'             => 'nullable|exists:badges,id',
            'pools'                      => 'nullable',
            'pools.*'                    => 'nullable',
            'views'                      => 'nullable',
            'views.*'                    => 'nullable',
            'toilets'                    => 'nullable',
            'toilets.*'                  => 'nullable',
            'kitchens'                   => 'nullable',
            'kitchens.*'                 => 'nullable',
            'extra.rules'                => 'nullable',
            'extra.arrival_instructions' => 'nullable',
            'extra.cancellation_policy'  => 'nullable',
            'extra.parking_information'  => 'nullable',
            'extra.wifi_information'     => 'nullable',
            'images'                     => 'required',
            'images.*'                   => 'nullable|mimes:jpeg,png,jpg,gif,svg,pdf,webp|max:2048',
            'fromDate'                   => 'sometimes|required',
            'fromDate.*'                 => 'sometimes|required|date',
            'toDate'                     => 'sometimes|required',
            'toDate.*'                   => 'sometimes|required|date',
            'price'                      => 'sometimes|required',
            'price.*'                    => 'sometimes|nullable',
            'availability'               => 'sometimes|required',
            'availability.*'             => 'sometimes|required',
        ];
        if ($this->get('toDate') != null) {
            foreach ($this->get('toDate') as $key => $value) {
                $rules['toDate.' . $key] = 'after_or_equal:fromDate.' . $key;
            }
        }
        if ($this->get('price') != null) {
            foreach ($this->get('price') as $key => $value) {
                $rules['price.' . $key] = 'required_if:availability.' . $key . ',1';
            }
        }
        return $rules;
    }

    /**
     * Attributes .
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'basic.category_id'          => __('lang.category'),
            'basic.city_id'              => __('lang.city'),
            'basic.district_id'          => __('lang.district'),
            'basic.size'                 => __('lang.size'),
            'basic.arrival_time'         => __('lang.arrival_time'),
            'basic.departure_time'       => __('lang.departure_time'),
            'basic.price'                => __('lang.price'),
            'basic.title'                => __('lang.title'),
            'basic.description'          => __('lang.description'),
            'basic.type_id'              => __('lang.type'),
            'basic.capacity_id'          => __('lang.capacity'),
            'basic.person_id'            => __('lang.person'),
            'basic.badge_id'             => __('lang.badge'),
            'pools'                      => __('lang.pools'),
            'pools.*'                    => __('lang.pools'),
            'views'                      => __('lang.views'),
            'views.*'                    => __('lang.views'),
            'toilets'                    => __('lang.toilets'),
            'toilets.*'                  => __('lang.toilets'),
            'kitchens'                   => __('lang.kitchens'),
            'kitchens.*'                 => __('lang.kitchens'),
            'extra.rules'                => __('lang.rules'),
            'extra.arrival_instructions' => __('lang.arrival_instructions'),
            'extra.cancellation_policy'  => __('lang.cancellation_policy'),
            'extra.parking_information'  => __('lang.parking_information'),
            'extra.wifi_information'     => __('lang.wifi_information'),
            'images'                     => __('lang.images'),
            'images.*'                   => __('lang.images'),
            'fromDate'                   => __('lang.fromDate'),
            'fromDate.*'                 => __('lang.fromDate'),
            'toDate'                     => __('lang.toData'),
            'toDate.*'                   => __('lang.toDate'),
            'price'                      => __('lang.price'),
            'price.*'                    => __('lang.price'),
            'availability'               => __('lang.availability'),
            'availability.*'             => __('lang.availability'),
        ];
    }
}
