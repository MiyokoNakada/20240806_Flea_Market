<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellRequest extends FormRequest
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
            'image' => ' required | image | mimes:jpg,jpeg,png,gif | max:2048',
            'category' => 'required',
            'condition_id' => 'required',
            'name' => 'required | string | max:191',
            'brand' => 'nullable | string | max:191',
            'description' => 'nullable | string | max:191',
            'price' => 'required | integer | min:1',
        ];
    }

    //エラーメッセージの編集
    public function messages()
    {
        return [
            'image.required' => '画像を選択してください',
            'image.image' => '指定されたファイルが画像ではありません',
            'image.mimes' => '指定された拡張子(jpg/jpeg/png/gif)ではありません',
            'image.max' => 'ファイルサイズは2MB以内にしてください',
            'category.required' => 'カテゴリーを選択してください',
            'condition_id.required' => '商品の状態を選択してください',
            'name.required' => '商品名を入力してください',
            'name.string' => '文字列で入力してください',
            'name.max' => '191字以下で入力してください',
            'brand.string' => '文字列で入力してください',
            'brand.max' => '191字以下で入力してください',
            'description.string' => '文字列で入力してください',
            'description.max' => '191字以下で入力してください',
            'price.required' => '販売価格を入力してください',
            'price.integer' => '数字で入力してください',
            'price.min' => '1以上の整数値を入力してください',
        ];
    }
}
