<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'comment' // 👈 'content' から 'comment' に修正
    ];

    /**
     * このコメントを投稿したユーザーを取得
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * このコメントが投稿された商品を取得
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}