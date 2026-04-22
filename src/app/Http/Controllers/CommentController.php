<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
// ★ ここで自作のリクエストファイルを読み込みます
use App\Http\Requests\CommentRequest; 
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * 商品へのコメント投稿 (FN020)
     * 引数を (CommentRequest $request) にすることで、
     * 自動的に日本語のバリデーションが実行されます。
     */
    public function store(CommentRequest $request, $productId)
    {
        // メソッド内の $request->validate(...) は不要なので削除しました。
        // ここに到達した時点で、CommentRequest によるバリデーションは成功しています。

        Comment::create([
            'user_id'    => Auth::id(),
            'product_id' => $productId,
            'comment'    => $request->comment, 
        ]);

        return back()->with('success', 'コメントを投稿しました');
    }
}