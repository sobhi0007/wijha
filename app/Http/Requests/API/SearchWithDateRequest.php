<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class SearchWithDateRequest extends FormRequest
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
            'city' => 'required' ,
            'check_in' => 'required|date|after_or_equal:'.now()->toDateString() ,
            'check_out' => 'required|date|after:check_in' ,
        ];
    }

    public function failedValidation(Validator $validator)
    {
       throw new HttpResponseException(response()->json([
        'status'=>422  ,
        'success'=>false,
        'message'   => 'Validation errors',
        'errors'=>$validator->errors(),
        'data' => null,  
       ]));
    }

}
