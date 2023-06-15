<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSliderRequest extends FormRequest
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
        $id = $this->route()->slider->id ?? null;
        return [
            'image'  => 'required|mimes:jpeg,png,jpg|max:2048',
            'link'   => 'nullable|url',
            'text.*' => 'required',
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
            'link'    => __('lang.link'),
            'text.en' => __('lang.text') . ' ' . __('lang.with_en'),
            'text.ar' => __('lang.text') . ' ' . __('lang.with_ar'),
        ];
    }
}
