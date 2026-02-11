<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>{{ $product->name }} の詳細</title>
    <style>
    /* 見本を再現するためのCSS */
.container {
    max-width: 900px;
    margin: 40px auto;
    padding: 20px;
}

.breadcrumb {
    margin-bottom: 20px;
    font-size: 14px;
    color: #66b3ff;
}
.breadcrumb a { color: #66b3ff; text-decoration: none; }

.main-content-layout {
    display: flex;
    gap: 40px; /* 左右の間隔 */
    margin-bottom: 30px;
}

.left-column { flex: 1; }
.right-column { flex: 1; }

.image-preview-container img {
    width: 100%;
    border-radius: 4px;
    background: #f9f9f9;
}

.file-upload-box {
    margin-top: 10px;
}

.form-group { margin-bottom: 20px; }
label { display: block; font-weight: bold; margin-bottom: 8px; color: #555; }

input[type="text"], input[type="number"], textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.season-checkbox-group {
    display: flex;
    gap: 15px;
}

.description-area textarea {
    height: 150px;
}

.form-footer {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 30px;
}

.btn-cancel {
    background: #ddd;
    padding: 10px 40px;
    text-decoration: none;
    color: #333;
    border-radius: 4px;
}

.btn-back {
    background-color: #d3d3d3;
    color: #333;
    padding: 10px 40px;
    border-radius: 5px;
    text-decoration: none;
}

.btn-save {
    background-color: #ffcc00;
    color: #333;
    padding: 10px 40px;
    border-radius: 5px;
    border: none;
    font-weight: bold;
    cursor: pointer;
}

.delete-container {
    display: flex;
    justify-content: flex-end;
    margin-top: -45px; /* 保存ボタンの横に並べる調整 */
}

.btn-delete-icon {
    background: #e0e0e0;
    border: 1px solid #ccc;
    padding: 8px;
    border-radius: 4px;
    cursor: pointer;
}

.delete-section {
    text-align: right;
    margin-top: -30px;
}

.btn-delete-trash {
    background: none;
    border: none;
    cursor: pointer;
    padding: 10px;
    transition: transform 0.2s;
}
.btn-delete-trash:hover {
    opacity: 0.7;
}
.trash-icon {
    font-size: 32px;
    color: #ff4d4d;
    text-shadow: 0 0 0 #ff4d4d; /* 絵文字の色を強制的に赤にする */
    -webkit-text-fill-color: transparent; /* ブラウザ標準の色を透明化 */
    display: inline-block;
}

.btn-delete-trash:hover .trash-icon {
    color: #cc0000;
    text-shadow: 0 0 0 #cc0000;
    transform: scale(1.1);
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

        <div class="main-content-layout">
            <div class="left-column">
                <div class="image-preview-container">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" id="preview">
                </div>
                <div class="file-upload-box">
                    <input type="file" name="image" id="image-input">
                </div>
                @error('image')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="right-column">
                <div class="form-group">
                    <label>商品名</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" placeholder="商品名を入力">
                    @error('name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>値段</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" placeholder="値段を入力">
                    @error('price')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>季節</label>
                    <div class="season-checkbox-group">
                        @php
                            // DBに登録されている季節IDを取得
                            $registeredSeasons = $product->seasons->pluck('id')->toArray();
                        @endphp
                        <label><input type="checkbox" name="seasons[]" value="1" {{ in_array(1, old('seasons', $registeredSeasons)) ? 'checked' : '' }}> 春</label>
                        <label><input type="checkbox" name="seasons[]" value="2" {{ in_array(2, old('seasons', $registeredSeasons)) ? 'checked' : '' }}> 夏</label>
                        <label><input type="checkbox" name="seasons[]" value="3" {{ in_array(3, old('seasons', $registeredSeasons)) ? 'checked' : '' }}> 秋</label>
                        <label><input type="checkbox" name="seasons[]" value="4" {{ in_array(4, old('seasons', $registeredSeasons)) ? 'checked' : '' }}> 冬</label>
                    </div>
                    @error('seasons')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="description-area">
            <label>商品説明</label>
            <textarea name="description" placeholder="商品の説明を入力">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-footer">
            <a href="{{ route('product.index') }}" class="btn-cancel">戻る</a>
            <button type="submit" class="btn-save">変更を保存</button>
        </div>
    </form>

    <div class="delete-section">
    <form action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete-trash" title="削除する">
            <span class="trash-icon">🗑️</span>
        </button>
    </form>
</div>
</div>
</body>
</html>