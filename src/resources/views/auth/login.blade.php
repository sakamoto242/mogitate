@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login__content">
  <div class="login__heading">
    <h2>Login</h2>
  </div>

  {{-- 中央に浮かぶ白いカード --}}
  <div class="login-form__card">
    <form class="form" action="/login" method="post">
      @csrf
      
      {{-- メールアドレス --}}
      <div class="form__group">
        <label class="form__label">メールアドレス</label>
        <div class="form__input">
          <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
        </div>
        <div class="form__error">
          @error('email') {{ $message }} @enderror
        </div>
      </div>

      {{-- パスワード --}}
      <div class="form__group">
        <label class="form__label">パスワード</label>
        <div class="form__input">
          <input type="password" name="password" placeholder="例: coachtech1106">
        </div>
        <div class="form__error">
          @error('password') {{ $message }} @enderror
        </div>
      </div>

      <div class="form__button">
        <button class="form__button-submit" type="submit">ログイン</button>
      </div>
    </form>
  </div>
</div>
@endsection