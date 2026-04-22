<?php

return [
    'required' => ':attributeを入力してください',
    'email'    => ':attributeはメール形式で入力してください',
    'unique'   => '指定した:attributeは既に使用されています', // ★追加
    'min'      => [
        'string' => ':attributeは:min文字以上で入力してください',
    ],
    'max'      => [
        'string' => ':attributeは:max文字以内で入力してください',
    ],
    'confirmed' => 'パスワードと一致しません',

    'attributes' => [
        'name'      => 'ユーザー名',     // ★「お名前」から変更
        'email'     => 'メールアドレス',
        'password'  => 'パスワード',
        'post_code' => '郵便番号',
        'address'   => '住所',
        'building'  => '建物名',
    ],
];