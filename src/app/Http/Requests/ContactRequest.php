<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ContactRequest;

class ContactRequest extends FormRequest
{
 

    public function authorize()
{
    return true; // falseからtrueへ変更
}

public function rules()
{
    return [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'tel' => ['required', 'numeric', 'digits_between:10,11'],
    ];
}

// 日本語のメッセージを設定
public function messages()
{
    return [
        'name.required' => '名前を入力してください',
        'email.required' => 'メールアドレスを入力してください',
        'email.email' => '有効なメールアドレス形式を入力してください',
        'tel.required' => '電話番号を入力してください',
        'tel.digits_between' => '電話番号を10桁から11桁の間で入力してください',
        // 必要に応じて他のメッセージも追加
    ];
}
}
