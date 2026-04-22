@extends('layouts.app')

@section('content')
{{-- FontAwesomeの読み込み --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .detail-container {
        max-width: 1100px;
        margin: 40px auto;
        padding: 0 20px;
        display: flex;
        gap: 50px;
        align-items: flex-start;
    }

    .image-box {
        flex: 1;
        width: 100%;
        text-align: center;
        position: relative;
    }

    .image-box img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 0 auto;
    }

    .sold-label {
        position: absolute;
        top: 0;
        left: 0;
        background: rgba(255, 0, 0, 0.8);
        color: white;
        padding: 10px 30px;
        font-weight: bold;
        font-size: 20px;
        z-index: 10;
    }

    .info-box { flex: 1; }
    .product-title { font-size: 28px; font-weight: bold; margin-bottom: 5px; margin-top: 0; }
    .brand-text { font-size: 16px; color: #666; margin-bottom: 20px; }
    .price-text { font-size: 28px; font-weight: bold; margin-bottom: 20px; }
    .price-text span { font-size: 16px; font-weight: normal; margin-left: 5px; }

    .action-row { display: flex; gap: 20px; margin-bottom: 25px; align-items: flex-start; }
    .action-item { text-align: center; color: #333; }
    .action-count { font-size: 12px; font-weight: bold; margin-top: 2px; }

    .like-button {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        outline: none;
    }

    .btn-purchase, .btn-sold {
        display: block; width: 100%; text-align: center;
        padding: 15px; border-radius: 4px; text-decoration: none; font-weight: bold; margin-bottom: 30px;
        font-size: 16px; border: none;
    }
    .btn-purchase { background: #ff5a5f; color: white; }
    .btn-sold { background: #888; color: white; cursor: not-allowed; }

    .sub-title { font-size: 18px; font-weight: bold; margin-top: 35px; border-bottom: 1px solid #ddd; padding-bottom: 12px; margin-bottom: 15px; }
    .description-content { white-space: pre-wrap; line-height: 1.8; margin-bottom: 35px; color: #333; }

    .info-table { width: 100%; border-collapse: collapse; }
    .info-table th { text-align: left; width: 120px; padding: 12px 0; font-weight: bold; color: #555; }
    .info-table td { padding: 12px 0; color: #333; }
    .tag { background: #e0e0e0; padding: 5px 15px; border-radius: 20px; font-size: 13px; margin-right: 5px; }

    .comment-list { margin-top: 25px; }
    .comment-item { margin-bottom: 20px; }
    .user-info { display: flex; align-items: center; gap: 12px; margin-bottom: 8px; }
    .user-icon { width: 35px; height: 35px; background: #ccc; border-radius: 50%; }
    .comment-bubble { background: #f0f0f0; padding: 12px 15px; border-radius: 4px; font-size: 14px; line-height: 1.6; color: #333; }
    
    .comment-form textarea { width: 100%; height: 120px; border: 1px solid #ccc; border-radius: 4px; padding: 12px; box-sizing: border-box; font-size: 16px; margin-top: 10px; resize: none; }
    .btn-comment { width: 100%; background: #ff5a5f; color: white; border: none; padding: 15px; border-radius: 4px; cursor: pointer; margin-top: 15px; font-weight: bold; font-size: 16px; }
</style>

<div class="detail-container">
    {{-- 左側：画像エリア --}}
    <div class="image-box">
        <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}">
        @if($product->buyer_id)
            <div class="sold-label">Sold</div>
        @endif
    </div>

    {{-- 右側：情報エリア --}}
    <div class="info-box">
        <h1 class="product-title">{{ $product->name }}</h1>
        <p class="brand-text">{{ $product->brand }}</p>
        <div class="price-text">¥{{ number_format($product->price) }} <span>(税込)</span></div>

        <div class="action-row">
            {{-- いいねボタン --}}
            <div class="action-item">
    @if(Auth::check() && $product->isLikedBy(Auth::user()))
        <form action="{{ route('like.destroy', ['productId' => $product->id]) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="like-button">
                <i class="fa-solid fa-star" style="font-size: 32px; color: #ff5a5f; cursor: pointer;"></i>
            </button>
        </form>
    @else
        <form action="{{ route('like.store', ['productId' => $product->id]) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="like-button">
                <i class="fa-regular fa-star" style="font-size: 32px; color: #888; cursor: pointer;"></i>
            </button>
        </form>
    @endif
    <div class="action-count" style="margin-top: 5px;">{{ $product->likes->count() }}</div>
</div>
修正のポイント:
            </div>

            {{-- コメントアイコン（カウントを動的に表示） --}}
            <div class="action-item">
                <i class="fa-regular fa-comment" style="font-size: 24px; color: #888;"></i>
                <div class="action-count">{{ $product->comments->count() }}</div>
            </div>
        </div>

        {{-- 購入ボタン (FN014 / FN017) --}}
@auth
    @if($product->user_id === Auth::id())
        {{-- 自分の出品物の場合：ボタンを無効化 --}}
        <button class="btn-sold" disabled style="background: #ccc;">
            自分の出品物です
        </button>
    @elseif($product->buyer_id)
        {{-- すでに売れている場合 --}}
        <button class="btn-sold" disabled>
            売り切れました
        </button>
    @else
        {{-- 他人の商品、かつ未購入の場合のみボタンを表示 --}}
        <a href="{{ route('purchase.show', ['id' => $product->id]) }}" class="btn-purchase">
            購入手続きへ
        </a>
    @endif
@else
    {{-- 未ログインの場合 --}}
    @if($product->buyer_id)
        <button class="btn-sold" disabled>売り切れました</button>
    @else
        <a href="{{ route('login') }}" class="btn-purchase">
            ログインして購入する
        </a>
    @endif
@endauth

        <h2 class="sub-title">商品説明</h2>
        <div class="description-content">{{ $product->description }}</div>

        <h2 class="sub-title">商品の情報</h2>
        <table class="info-table">
            <tr>
                <th>カテゴリー</th>
                <td><span class="tag">{{ $product->category }}</span></td>
            </tr>
            <tr>
                <th>商品の状態</th>
                <td>{{ $product->condition }}</td>
            </tr>
        </table>

        {{-- ★ コメント表示ループ (FN019) --}}
        <h2 class="sub-title">コメント({{ $product->comments->count() }})</h2>
        <div class="comment-list">
            @forelse($product->comments as $comment)
                <div class="comment-item">
                    <div class="user-info">
                        <div class="user-icon"></div>
                        <strong>{{ $comment->user->name }}</strong>
                    </div>
                    <div class="comment-bubble">
                        {{ $comment->comment }}
                    </div>
                </div>
            @empty
                <p style="color: #888;">まだコメントはありません。</p>
            @endforelse
        </div>

        {{-- ★ コメント投稿フォーム (FN019) --}}
        @auth
            <form action="{{ route('comment.store', ['productId' => $product->id]) }}" method="POST" class="comment-form">
                @csrf
                <p style="font-weight: bold; margin-top: 20px;">商品へのコメント</p>
                <textarea name="comment" placeholder="コメントを入力してください">{{ old('comment') }}</textarea>
    
    {{-- エラー表示の追加 --}}
    @error('comment')
        <p class="error-message" style="color: #dc3545; font-size: 14px; margin-top: 5px;">
            <strong>{{ $message }}</strong>
        </p>
    @enderror
                <button type="submit" class="btn-comment">コメントを送信する</button>
            </form>
        @else
            <p style="margin-top: 20px;"><a href="{{ route('login') }}">ログイン</a>するとコメントできます。</p>
        @endauth
    </div>
</div>
@endsection