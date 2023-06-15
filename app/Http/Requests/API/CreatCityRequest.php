<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class CreatCityRequest extends FormRequest
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
            'name_en' => 'required|unique:cities|max:100' ,
            'name_ar' => 'required|unique:cities|max:100' ,
        ];
    }

    public function failedValidation(Validator $validator)
    {
       throw new HttpResponseException(response()->json([
        'Message'   => 'Validation errors',
        'Status'=>403 ,
        'Data' => $validator->errors(),
       
       ]));
    }


    public function messages()
{
    if(app()->getLocale()=='en'){
        return [
            'name_en.required' => 'City name in english is required .',
            'name_ar.required' => 'City name in arabic is required .',
            'name_en.unique'   => 'City name in english is already exists in our database .',
            'name_ar.unique'   => 'City name in arabic is already exists in our database .',
            'name_en.max'      => 'City name in english must not be greater than 100 characters .',
            'name_ar.max'      => 'City name in arabic must not be greater than 100 characters .',
        ];
    }else{
        return [
            'name_en.required' => 'المدينه باللغه الانجليزيه مطلوبه .' ,
            'name_ar.required' => 'المدينه باللغه الانجليزيه مطلوبه .',
            'name_en.unique'   => 'المدينه باللغه الانجليزيه موجوده بالفعل',
            'name_ar.unique'   => 'المدينه باللغه العربيه موجوده بالفعل',
            'name_en.max'      => 'المدينه باللغه الانجليزيه يجب الا تكون اكثر من 100 حرف',
            'name_ar.max'      => 'المدينه باللغه العربيه يجب الا تكون اكثر من 100 حرف',
        ];
    }
    
 }
}
