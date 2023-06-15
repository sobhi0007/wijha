<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
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
        $id = $this->route()->faq->id ?? null;
        return [
            'question_en' => 'required',
            'question_ar' => 'required',
            'answer_en'   => 'required',
            'answer_ar'   => 'required',
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
            'question_en' => __('lang.faq') . ' ' . __('lang.with_en'),
            'question_ar' => __('lang.faq') . ' ' . __('lang.with_ar'),
            'answer_en' => __('lang.answer') . ' ' . __('lang.with_en'),
            'answer_ar' => __('lang.answer') . ' ' . __('lang.with_ar'),
        ];
    }
}
