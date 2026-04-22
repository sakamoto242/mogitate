<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;

/* --- 1. 一般公開（ログイン不要） --- */
Route::get('/', function () { return redirect('/products'); });
Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');

/* --- 2. 認証関連 (Login/Register) --- */
Auth::routes(['verify' => true]);

/* --- 3. 認証済みユーザー専用 (ログイン必須) --- */
Route::middleware(['auth'])->group(function () {
    
    // マイページ・プロフィール
    Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');
    Route::get('/mypage/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
    // web.php の 24行目
Route::post('/mypage/profile/update', [UserProfileController::class, 'update'])->name('profile.update');

    // メール確認済みのユーザーのみアクセス可能なグループ
    Route::middleware(['verified'])->group(function () {
        // プロフィール設定画面（初回用）
        Route::get('/profile/setup', [ProfileController::class, 'create'])->name('profile.setup');
        Route::post('/profile/setup', [ProfileController::class, 'store'])->name('profile.store');
    });

    // 出品関連
    Route::get('/sell', [ProductController::class, 'create'])->name('products.create');
    Route::post('/sell', [ProductController::class, 'store'])->name('products.store');

    /* --- 購入フロー (Stripe連携) --- */
    // 購入手続き画面の表示
    Route::get('/purchase/{id}', [ProductController::class, 'purchase'])->name('purchase.show');
    
    // 購入実行（Stripe決済画面へリダイレクトする処理）
    // Bladeの route('purchase.store') と一致させています
    Route::post('/purchase/{id}', [ProductController::class, 'executePurchase'])->name('purchase.store');
    
    // 決済成功後の処理（データベースの buyer_id を更新する）
    Route::get('/purchase/success/{id}', [ProductController::class, 'success'])->name('purchase.success');

    // 配送先変更
    Route::get('/purchase/address/{id}', [ProductController::class, 'editAddress'])->name('address.edit');
    Route::post('/purchase/address/{id}', [ProductController::class, 'updateAddress'])->name('address.update');

    // お気に入り (Like)
    Route::post('/product/{productId}/like', [LikeController::class, 'store'])->name('like.store');
    Route::post('/product/{productId}/unlike', [LikeController::class, 'destroy'])->name('like.destroy');

    // コメント
    Route::post('/product/{productId}/comment', [CommentController::class, 'store'])->name('comment.store');
});

// デフォルトのホーム
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/stripe/webhook', [ProductController::class, 'handleWebhook']);