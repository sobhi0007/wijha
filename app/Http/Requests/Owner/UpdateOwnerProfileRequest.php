<?php

namespace App\Http\Requests\Owner;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOwnerProfileRequest extends FormRequest
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
        $id = Auth::guard('owner')->user()->id;
        return [
            'name'                 => 'sometimes|required|string',
            'email'                => 'sometimes|required|unique:users,email,' . $id,
            'current_password'     => 'sometimes|required',
            'new_password'         => 'sometimes|required|min:6',
            'confirm_new_password' => 'sometimes|required|same:new_password',
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
            'name'                 => __('lang.name'),
            'email'                => __('lang.email'),
            'password'             => __('lang.password'),
            'current_password'     => __('lang.current_password'),
            'new_password'         => __('lang.new_password'),
            'confirm_new_password' => __('lang.confirm_new_password'),
        ];
    }
}
