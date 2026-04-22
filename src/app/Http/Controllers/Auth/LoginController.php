<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; // 追記
use Illuminate\Validation\ValidationException; // 追記

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * 【テストケース対応】
     * 認証失敗時のバリデーションメッセージをカスタマイズ
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => ['ログイン情報が登録されていません'],
        ]);
    }

    /**
     * 【テストケース対応】
     * ログアウト後のリダイレクト先をトップページに指定
     */
    protected function loggedOut(Request $request)
    {
        return redirect('/');
    }
    // LoginController.php 内に追加
protected function authenticated(Request $request, $user)
{
    // 通常のログイン時はマイリストへ
    return redirect('/?page=mylist');
}
}