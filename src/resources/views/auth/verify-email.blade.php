@extends('layouts.app')

@section('content')
<div class="verify-email__content" style="text-align: center; padding: 100px 20px;">
    <p style="font-size: 18px; line-height: 1.6; margin-bottom: 40px;">
        登録していただいたメールアドレスに認証メールを送付しました。<br>
        メール認証を完了してください。
    </p>

    <div class="verify-email__button">
        <form action="{{ route('verification.send') }}" method="post">
            @csrf
            <button type="submit" style="background: #ddd; border: 1px solid #999; padding: 15px 40px; border-radius: 4px; cursor: pointer; font-size: 16px;">
                認証はこちらから
            </button>
        </form>
    </div>

    <div style="margin-top: 20px;">
        <a href="/" style="color: #007bff; text-decoration: none; font-size: 14px;">認証メールを再送する</a>
    </div>
</div>
@endsection