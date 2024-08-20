<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required | string | max:191',
            'profile_image' => ' nullable | image | mimes:jpg,jpeg,png,gif | max:2048',
            'postal_code' => 'required | integer | digits:7 ',
            'address' => 'required | string | max:191',
            'building' => 'nullable | string | max:191',
            
        ];
    }

    //エラーメッセージの編集
    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'name.string' => '文字列で入力してください',
            'name.max' => '191字以下で入力してください',
            'profile_image.image' => '指定されたファイルが画像ではありません',
            'profile_image.mimes' => '指定された拡張子(jpg/jpeg/png/gif)ではありません',
            'profile_image.max' => 'ファイルサイズは2MB以内にしてください',
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
