<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RatingRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'rating' => 'required|integer|between:1,5',
            'comment' => 'max:255',
        ];
    }

    public function messages()
    {
        return [
            'rating.required' => ':attributeは入力必須です',
            'rating.between' => ':attributeは1～5段階で入力してください',
            'comment.max' => ':attributeは255字以内で入力してください',
        ];
    }

    public function attributes()
    {
        return [
            'rating' => '評価',
            'comment' => 'コメント'
        ];
    }
}
