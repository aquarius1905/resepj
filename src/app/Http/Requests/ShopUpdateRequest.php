<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopUpdateRequest extends FormRequest
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
            'name' => 'required|max:255',
            'area_id' => 'required',
            'genre_id' => 'required',
            'overview' => 'required|max:255',
            'course_names.*' => 'required|max:255',
            'course_prices.*' => 'required|regex:/^[1-9][0-9]+$/i',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeは入力必須です',
            'max' => ':attributeは255文字以内で入力してください',
            'regex' => ':attributeには半角数字、かつ正しい入力形式を指定してください'
        ];
    }

    public function attributes()
    {
        return [
            'name' => '店名',
            'area_id' => 'エリア',
            'genre_id' => 'ジャンル',
            'overview' => '概要',
            'course_names.*' => 'コース名',
            'course_prices.*' => '金額'
        ];
    }
}
