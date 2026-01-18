<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController; // 追加

Route::get('/', [ContactController::class, 'index']); // 追加
Route::post('/contacts/confirm', [ContactController::class, 'confirm']);
Route::post('/contacts', [ContactController::class, 'store']);