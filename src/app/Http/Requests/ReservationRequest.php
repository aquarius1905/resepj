<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'date' => 'required|date|after:today',
            'time' => 'required|date_format:H:i',
            'number' => 'required|integer|between:1,100',
            'course_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'date.date' => '日付の形式で入力してください',
            'date.after' => '明日以降の日付を指定してください',
            'time.date_format' => '時間は時:分で入力してください',
            'number.between' => ':attributeは1人以上100人以内で指定してください',
        ];
    }

    public function attributes()
    {
        return [
            'date' => '日付',
            'time' => '時間',
            'number' => '人数',
            'course_id' => 'コース',
        ];
    }
}
