<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRegisterRequest extends FormRequest
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
            'img' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'img.required' => '写真は添付必須です',
            'regex' => ':attributeには1以上の半角数字を入力してください'
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
