<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'email' => 'required | string | email | max:191',
            'password' => 'required | min:8 | max:191',
        ];
    }
    
    public function messages()
    {
        return [
            'email.required' => 'メールアドレスを入力してください',
            'email.string' => '文字列で入力してください',
            'email.email' => '「ユーザー名@ドメイン」形式で入力してください',
            'email.max' => '191字以下で入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.min' => '8字以上で入力してください',
            'password.max' => '191字以下で入力してください',
        ];
    }
}
