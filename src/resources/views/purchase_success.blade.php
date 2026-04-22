@extends('layouts.app')

@section('content')
<div style="text-align: center; margin-top: 100px;">
    <h1>ご購入ありがとうございます！</h1>
    <p>「{{ $product->name }}」の決済が完了しました。</p>
    <a href="/" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background: #ff5a5f; color: white; text-decoration: none; border-radius: 4px;">トップページへ戻る</a>
</div>
@endsection