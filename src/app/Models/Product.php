<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    // 保存を許可する項目をすべて書き並べます
    protected $fillable = [
        'user_id',     // ログイン中のユーザーID用
        'name',        // 商品名
        'price',       // 価格
        'image_url',   // 画像パス
        'description', // 商品説明
        'category',    // カテゴリー
        'condition',   // 商品の状態
        'brand',       // ブランド（任意）
        'buyer_id',
    ];

    public function seasons()
    {
        return $this->belongsToMany(Season::class);
    }
    // 商品が持っている「いいね」の一覧を取得できるようにする
public function likes()
{
    return $this->hasMany(Like::class);
}

// ログイン中のユーザーがこの商品をいいねしているか判定する
public function isLikedBy($user): bool
{
    if (!$user) {
        return false;
    }
    return $this->likes()->where('user_id', $user->id)->exists();
}
public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function categories()
    {
        // Categoryモデルとの多対多のリレーションを定義
        return $this->belongsToMany(Category::class, 'category_product');
    }
}