<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品編集 | mogitate</title>
    <style>
    /* 全体レイアウト */
    body {
        margin: 0;
        background-color: #fcfcfc;
        font-family: "Helvetica Neue", Arial, "Hiragino Kaku Gothic ProN", "Hiragino Sans", Meiryo, sans-serif;
    }

    .main-header {
        padding: 20px 40px;
        background: #fff;
        border-bottom: 1px solid #eee;
    }

    .logo {
        font-size: 32px;
        font-weight: 900;
        color: #e3c400;
        text-decoration: none;
        font-style: italic;
        font-family: 'Arial Black', sans-serif;
        letter-spacing: -1px;
    }

    .container {
        max-width: 900px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .breadcrumb {
        margin-bottom: 30px;
        font-size: 14px;
    }
    .breadcrumb a { text-decoration: none; color: #007bff; }
    .breadcrumb span { color: #666; }

    .editor-layout {
        display: flex;
        gap: 60px;
        margin-bottom: 30px;
    }

    .image-section { flex: 1; }
    .image-preview img {
        width: 100%;
        border-radius: 4px;
        margin-bottom: 15px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .form-section { flex: 1.2; }

    .form-group { margin-bottom: 25px; }
    label {
        display: block;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }

    input[type="text"], input[type="number"], textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background: #fff;
        box-sizing: border-box;
    }

    textarea { height: 150px; resize: none; margin-bottom: 10px; }

    /* チェックボックス */
    .checkbox-group { display: flex; gap: 20px; margin-top: 5px; }
    .checkbox-label {
        display: flex;
        align-items: center;
        cursor: pointer;
        font-size: 14px;
    }
    
    input[type="checkbox"] {
        appearance: none;
        width: 18px;
        height: 18px;
        border: 1px solid #ccc;
        border-radius: 50%;
        margin-right: 8px;
        cursor: pointer;
        position: relative;
    }
    input[type="checkbox"]:checked {
        background: #444;
        border-color: #444;
    }
    input[type="checkbox"]:checked::after {
        content: "✓";
        color: white;
        font-size: 12px;
        position: absolute;
        left: 3px;
        top: -1px;
    }

    /* エラーメッセージ */
    .error-message {
        color: #ff0000 !important;
        font-size: 13px;
        margin: 5px 0;
        font-weight: bold;
        display: block;
    }

    .action-footer {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-top: 50px;
        padding-bottom: 40px;
    }

    .btn-back {
        background: #e0e0e0;
        color: #333;
        padding: 12px 60px;
        border-radius: 4px;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-update {
        background: #ffcc00;
        color: #333;
        border: none;
        padding: 12px 60px;
        border-radius: 4px;
        font-weight: bold;
        cursor: pointer;
    }

    .delete-area {
        text-align: right;
        margin-top: -85px;
        padding-right: 10px;
    }
    .btn-delete-icon {
        background: none;
        border: none;
        cursor: pointer;
        padding: 10px;
    }
    .trash-svg-icon {
        font-size: 32px;
        color: #ff4d4d;
    }
</style>
</head>
<body>

   <header class="main-header">
        <div class="header-container">
            <a href="{{ route('product.index') }}" class="logo">mogitate</a>
        </div>
    </header>

    <div class="container">
        <nav class="breadcrumb">
            <a href="{{ route('product.index') }}">商品一覧</a> &gt; <span>{{ $product->name }}</span>
        </nav>

        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="editor-layout">
                <div class="image-section">
                    <div class="image-preview">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    </div>
                    <div class="file-input-wrapper">
                        <input type="file" name="image" id="image-upload">
                        @if($errors->has('image'))
                            @foreach($errors->get('image') as $message)
                                <p class="error-message">{{ $message }}</p>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-group">
                        <label>商品名</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" placeholder="商品名を入力">
                        @if($errors->has('name'))
                            @foreach($errors->get('name') as $message)
                                <p class="error-message">{{ $message }}</p>
                            @endforeach
                        @endif
                    </div>

                    <div class="form-group">
                        <label>値段</label>
                        <input type="text" name="price" value="{{ old('price', $product->price) }}" placeholder="値段を入力">
                        @if($errors->has('price'))
                            @foreach($errors->get('price') as $message)
                                <p class="error-message">{{ $message }}</p>
                            @endforeach
                        @endif
                    </div>

                    <div class="form-group">
                        <label>季節</label>
                        <div class="checkbox-group">
                            @foreach($seasons as $season)
                                <label class="checkbox-label">
                                    <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                                        {{ in_array($season->id, old('seasons', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
                                    {{ $season->name }}
                                </label>
                            @endforeach
                        </div>
                        @if($errors->has('seasons'))
                            @foreach($errors->get('seasons') as $message)
                                <p class="error-message">{{ $message }}</p>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="description-section">
                <label>商品説明</label>
                <textarea name="description" placeholder="商品の説明を入力">{{ old('description', $product->description) }}</textarea>
                @if($errors->has('description'))
                    @foreach($errors->get('description') as $message)
                        <p class="error-message">{{ $message }}</p>
                    @endforeach
                @endif
            </div>

            <div class="action-footer">
                <a href="{{ route('product.index') }}" class="btn-back">戻る</a>
                <button type="submit" class="btn-update">変更を保存</button>
            </div>
        </form>

        <div class="delete-area">
            <form action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete-icon" title="削除する">
                    <span class="trash-svg-icon">🗑</span> 
                </button>
            </form>
        </div>
    </div>
</body>
</html>