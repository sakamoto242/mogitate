<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function mypage(Request $request)
    {
        $user = Auth::user();
        
        // URLの ?tab= の値を取得（指定がない場合は 'sell' にする）
        $tab = $request->query('tab', 'sell');

        if ($tab === 'buy') {
            // 購入した商品（buyer_id が自分のID）
            $products = Product::where('buyer_id', $user->id)->get();
        } else {
            // 出品した商品（user_id が自分のID）
            $products = Product::where('user_id', $user->id)->get();
        }

        // ビューに $user, $products, $tab を渡す
        return view('mypage', compact('user', 'products', 'tab'));
    }
    public function update(Request $request)
{
    // ★ここを修正
    $request->validate([
        'name' => 'required|string|max:255',
        'post_code' => 'required|digits:7', // digits:7 に変更
        'address' => 'required|string|max:255',
        'building_name' => 'nullable|string|max:255',
    ], [
        // ★カスタムメッセージを追加
        'post_code.digits' => '郵便番号はハイフンなしの7桁で入力してください',
    ]);

    // ... その下の保存処理（$user->update(...) など）はそのまま ...
}
}