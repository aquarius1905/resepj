<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRepresentativeRegisterRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:shop_representatives|max:255',
            'password' => 'required|between:8,255'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeは入力必須です',
            'email.email' => ':attributeの形式で入力してください',
            'email.max' => ':attributeは255文字以内で入力してください',
            'password.between' => ':attributeは8文字以上255文字以内で入力してください',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '名前',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
        ];
    }
}
