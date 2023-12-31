<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|min:2|max:40',
            'email' => 'required|email|unique:users,email',
            'phone' =>'required|regex:/^([0-9\s\-\+\(\)]*)$/|unique:users,phone',
            'password' => 'required|min:8|max:12|confirmed',
            'password_confirmation' => 'required',
            'fcm_token'=> 'nullable'
        ];
    }


protected function failedValidation(Validator $validator)
{
    $errors = (new ValidationException($validator))->errors();
    $responseData = [
        'status' => 422 ,
        'success' => false,
        'message' => 'Validation Errors .',
        'errors' =>  $errors,
        'data' => null,
    ];

    throw new HttpResponseException(
        response()->json( $responseData, 422)
    );
}
}
