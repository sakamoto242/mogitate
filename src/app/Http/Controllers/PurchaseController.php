<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    // ★ 1. 購入確認画面を表示する（web.phpの定義に合わせる）
   
    // ★ 1. 購入確認画面を表示する
    public function showPurchasePage($id)
    {
        $product = Product::findOrFail($id);
        
        // 売り切れチェック
        if ($product->buyer_id) {
            return redirect()->back()->with('error', 'この商品は既に売り切れています。');
        }

        // ★ ここを追加：ログインユーザーを取得する
        $user = Auth::user();

        // ★ compact に 'user' を追加して View に渡す
        return view('purchase_confirm', compact('product', 'user'));
    }

    // ★ 2. 決済セッションを作成してStripeへ飛ばす（「購入する」ボタン用）
    public function executePurchase($id)
    {
        $product = Product::findOrFail($id);

        // ストライプのシークレットキー設定
        $stripeSecret = config('services.stripe.secret') ?? env('STRIPE_SECRET');
        if (!$stripeSecret) {
            return "Error: Stripe API Key is not set in .env file.";
        }
        Stripe::setApiKey($stripeSecret);

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => ['name' => $product->name],
                    'unit_amount' => $product->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('purchase.success', ['id' => $product->id]),
            'cancel_url' => route('purchase.show', ['id' => $product->id]),
        ]);

        return redirect()->away($session->url);
    }

    public function success($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['buyer_id' => Auth::id()]);

        return view('purchase_success', compact('product'));
    }
}