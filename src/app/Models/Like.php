<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // ★ 一括保存（Mass Assignment）を許可するカラムを指定
    protected $fillable = [
        'user_id',
        'product_id',
    ];

    // 商品とのリレーション
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // ユーザーとのリレーション
    public function user()
    {
       return $this->belongsTo(User::class);
    }
}