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
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|unique:shop_representatives|max:255',
            'password' => 'required|string|min:8|max:255'
        ];
    }

    public function attributes()
    {
        return [
            'name' => '店舗代表者名'
        ];
    }
}
