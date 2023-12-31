<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class LoginUserRequest extends FormRequest
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
     
        if( filter_var($this->emailOrPhone,FILTER_VALIDATE_EMAIL)){
          return  [
                'emailOrPhone' => ['required', 'string', 'email'],
                'password' => ['required', 'string'],
            ];
        }else{
          return  [
                'emailOrPhone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
                'password' => ['required', 'string'],
            ];
        }

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
