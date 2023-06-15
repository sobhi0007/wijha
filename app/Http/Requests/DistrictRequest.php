<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DistrictRequest extends FormRequest
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
        $id = $this->route()->district->id ?? null;
        return [
            'name_en' => 'required',
            'name_ar' => 'required',
            'city_id' => 'required|exists:cities,id',
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
            'name_en' => __('lang.name') . ' ' . __('lang.with_en'),
            'name_ar' => __('lang.name') . ' ' . __('lang.with_ar'),
            'city_id' => __('lang.city'),
        ];
    }
}
