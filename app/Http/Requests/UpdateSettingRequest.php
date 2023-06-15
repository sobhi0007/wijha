<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
            'logo'        => 'sometimes|nullable|mimes:jpeg,png,jpg|max:2048',
            'terms'       => 'sometimes|nullable',
            'address'     => 'sometimes|nullable',
            'phone1'      => 'sometimes|nullable|numeric',
            'phone2'      => 'sometimes|nullable|numeric',
            'email1'      => 'sometimes|nullable|email',
            'email2'      => 'sometimes|nullable|email',
            'facebook'    => 'sometimes|nullable|url',
            'linkedin'    => 'sometimes|nullable|url',
            'instagram'   => 'sometimes|nullable|url',
            'youtube'     => 'sometimes|nullable|url',
            'twitter'     => 'sometimes|nullable|url',
            'pinterest'   => 'sometimes|nullable|url',
            'google_play' => 'sometimes|nullable|url',
            'app_store'   => 'sometimes|nullable|url',
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
            'terms'       => __('lang.terms'),
            'logo'        => __('lang.logo'),
            'address'     => __('lang.address'),
            'phone1'      => __('lang.phone1'),
            'phone2'      => __('lang.phone2'),
            'email1'      => __('lang.email1'),
            'email2'      => __('lang.email2'),
            'facebook'    => __('lang.facebook'),
            'linkedin'    => __('lang.linkedin'),
            'instagram'   => __('lang.instagram'),
            'youtube'     => __('lang.youtube'),
            'twitter'     => __('lang.twitter'),
            'pinterest'   => __('lang.pinterest'),
            'google_play' => __('lang.google_play'),
            'app_store'   => __('lang.app_store'),
        ];
    }
}
