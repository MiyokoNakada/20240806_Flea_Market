<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
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
            'title' => 'required | string | max:191',
            'email_address' => 'required | string | email | max:191',
            'body' => 'required | string',
        ];
    }

    //エラーメッセージの編集
    public function messages()
    {
        return [
            'title.required' => 'タイトルを入力してください',
            'title.string' => '文字列で入力してください',
            'title.max' => '191字以下で入力してください',
            'email_address.required' => 'メールアドレスを入力してください',
            'email_address.string' => '文字列で入力してください',
            'email_address.email' => '「ユーザー名@ドメイン」形式で入力してください',
            'email_address.max' => '191字以下で入力してください',
            'body.required' => '本文を入力してください',
            'body.string' => '文字列で入力してください',
        ];
    }
}
