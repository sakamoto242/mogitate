@extends('layouts.app')

@section('css')
<style>
  /* 背景と全体のレイアウト */
  body {
      background-color: #f2eee9 !important;
      margin: 0;
      font-family: "Hiragino Kaku Gothic Pro", "Meiryo", sans-serif;
  }
  .register__content {
      padding: 80px 0;
  }
  .register__heading {
      text-align: center;
      margin-bottom: 40px;
  }
  .register__heading h2 {
      font-family: 'Inika', serif;
      font-size: 30px;
      color: #8b7969;
      font-weight: normal;
  }

  /* 白いカードを中央に固定 */
  .register-form__card {
      background: #fff;
      width: 90%;
      max-width: 600px;
      margin: 0 auto;
      padding: 60px 80px;
      border-radius: 4px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.02);
  }

  /* 入力項目を縦に並べる（重要！） */
  .form__group {
      margin-bottom: 25px;
      display: flex;
      flex-direction: column; /* 縦並びを強制 */
  }

  /* ラベルを見本通り左上に配置 */
  .form__label {
      display: block;
      font-size: 16px;
      color: #8b7969;
      margin-bottom: 10px;
      text-align: left;
  }

  /* 入力欄のデザイン（青色を排除） */
  .form__input input {
      width: 100%;
      padding: 15px;
      border: none;
      background: #f4f4f4 !important; /* 見本の薄グレー */
      color: #8b7969;
      font-size: 16px;
      outline: none;
      box-sizing: border-box;
  }

  /* 自動入力の青色背景を強制上書き */
  input:-webkit-autofill {
      -webkit-box-shadow: 0 0 0px 1000px #f4f4f4 inset !important;
  }

  /* 登録ボタンを中央へ */
  .form__button {
      text-align: center;
      margin-top: 40px;
  }
  .form__button-submit {
      background: #8b7969;
      color: #fff;
      border: none;
      padding: 10px 60px;
      font-size: 16px;
      cursor: pointer;
  }
</style>
@endsection

@section('content')
<div class="register__content">
  <div class="register__heading">
    <h2>Register</h2>
  </div>

  <div class="register-form__card">
    <form class="form" action="/register" method="post">
      @csrf
      <div class="form__group">
        <label class="form__label">お名前</label>
        <div class="form__input">
          <input type="text" name="name" value="{{ old('name') }}" placeholder="例: 山田 太郎">
        </div>
      </div>

      <div class="form__group">
        <label class="form__label">メールアドレス</label>
        <div class="form__input">
          <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
        </div>
      </div>

      <div class="form__group">
        <label class="form__label">パスワード</label>
        <div class="form__input">
          <input type="password" name="password" placeholder="例: coachtech1106">
        </div>
      </div>

      <div class="form__button">
        <button class="form__button-submit" type="submit">登録</button>
      </div>
    </form>
  </div>
</div>
@endsection