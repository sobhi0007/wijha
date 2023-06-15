<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCityRequest extends FormRequest
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
        $id = $this->route()->city->id ?? null;
        return [
            'image'   => 'required|mimes:jpeg,png,jpg|max:2048',
            'name_en' => 'required|unique:cities,name_en,' . $id,
            'name_ar' => 'required|unique:cities,name_ar,' . $id,
            'featured'    => 'nullable',
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
            'image'   => __('lang.image'),
            'name_en' => __('lang.name') . ' ' . __('lang.with_en'),
            'name_ar' => __('lang.name') . ' ' . __('lang.with_ar'),
        ];
    }
}
