<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// --- 商品一覧 ---
Route::get('/products', [ProductController::class, 'index'])->name('product.index');

// --- 商品登録（{id}より上に書く） ---
Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/products', [ProductController::class, 'store'])->name('product.store');

// --- 編集画面（/edit がつくもの） ---
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');

// --- 更新・削除・詳細 ---
Route::patch('/products/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');