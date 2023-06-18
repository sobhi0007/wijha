<?php

namespace App\Http\Requests\Owner;

use App\Traits\ApiResponse;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateOwnerProfileRequest extends FormRequest
{
    use ApiResponse;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        if ($this->is('api/*')) {
            $response = new Response(['error' => $validator->errors()->all()], 422);
            throw new ValidationException($validator, $response);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->expectsJson() ? $this->user()?->id : Auth::guard('owner')->user()?->id;
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
