<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'postal_code' => 'required | integer | digits:7 ',
            'address' => 'required | string | max:191',
            'building' => 'nullable | string | max:191',

        ];
    }

    //エラーメッセージの編集
    public function messages()
    {
        return [
            'postal_code.required' => '郵便番号を入力してください',
            'postal_code.integer' => '数字で入力してください',
            'postal_code.digits' => 'ハイフンを除く7桁の数字で入力してください',
            'address.required' => '住所を入力してください',
            'address.string' => '文字列で入力してください',
            'address.max' => '191字以下で入力してください',
            'building.string' => '文字列で入力してください',
            'building.max' => '191字以下で入力してください',
        ];
    }
}
