<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
       
        return [
            'code'   => 'required|exists:units,code',
            'booking'   => 'required|exists:bookings,id',
            'rate' => 'required|numeric|between:1,5' ,
            'review' => 'required|max:500|string',
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
