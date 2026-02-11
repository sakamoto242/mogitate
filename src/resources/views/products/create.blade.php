<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品登録</title>
    <style>
  /* 1. フォーム全体を中央に寄せ、幅を制限する */
.container {
    max-width: 600px; /* 広がりすぎないように制限 */
    margin: 60px auto;
    padding: 0 20px;
    font-family: sans-serif;
}

h1 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 40px;
    color: #333;
}

/* 2. 各項目のレイアウト */
.form-group {
    margin-bottom: 30px;
}

.label-container {
    display: flex;
    align-items: center;
    margin-bottom: 12px;
}

label {
    font-weight: bold;
    font-size: 16px;
    margin-right: 15px;
}

.required-tag {
    background-color: #ff0000;
    color: #fff;
    font-size: 11px;
    padding: 2px 6px;
    border-radius: 2px;
    font-weight: bold;
}

/* 3. 入力欄のデザイン（見本のように角を少し丸く、背景を薄いグレーに） */
input[type="text"],
input[type="number"],
textarea {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    background-color: #f9f9f9;
    box-sizing: border-box;
    font-size: 15px;
}

textarea {
    height: 150px; /* テキストエリアの高さを確保 */
}

/* 4. ボタンエリアを中央に配置する */
.btn-group {
    display: flex;
    justify-content: center; /* 中央寄せ */
    gap: 20px;
    margin-top: 50px;
}

/* 戻る（キャンセル）ボタン */
.btn-back {
    background-color: #e0e0e0;
    color: #333;
    padding: 12px 60px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
    text-align: center;
    min-width: 150px;
}

/* 登録ボタン */
.btn-submit {
    background-color: #ffcc00; /* 見本の黄色 */
    color: #333;
    padding: 12px 60px;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
    min-width: 150px;
}

.btn-submit:hover {
    background-color: #f0c000;
}
/* 季節のチェックボックスを横に並べる */
.checkbox-group {
    display: flex;
    gap: 20px;
    margin-top: 10px;
}

.checkbox-group label {
    font-weight: normal; /* チェックボックスの文字は細く */
    display: flex;
    align-items: center;
    gap: 5px;
    cursor: pointer;
}

/* 「複数選択可」の文字を小さく赤くする */
.optional-text {
    color: #ff4d4d;
    font-size: 12px;
    margin-left: 10px;
    font-weight: normal;
}

/* ヘッダー全体の余白 */
.main-header {
    width: 100%;
    padding: 30px 0 10px; /* 上にゆとりを持たせる */
    background-color: #fff;
}

/* ロゴの位置をフォームの左端と揃える */
.header-container {
    max-width: 800px; /* フォームの container と同じ幅にする */
    margin: 0 auto;
    padding: 0 40px;
}

/* ロゴのデザイン再現 */
.logo {
    font-family: 'Georgia', serif; /* セリフ体で見本に近づける */
    font-size: 28px;
    font-weight: bold;
    font-style: italic;     /* 斜体 */
    color: #ffcc00;         /* 鮮やかな黄色 */
    text-decoration: none;  /* 下線を消す */
    opacity: 0.8;           /* 少し透明度を下げると見本の色味に近くなります */
}

.error-message {
    color: #ff0000;
    font-size: 13px;
    margin-top: 5px;
    font-weight: bold;
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
    <h1>商品登録</h1>
    
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <div class="label-container">
                <label>商品名</label>
                <span class="required-tag">必須</span>
            </div>
            <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}">
            @error('name')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
    <div class="label-container">
        <label>値段</label>
        <span class="required-tag">必須</span>
    </div>
    <input type="number" name="price" value="{{ old('price') }}" placeholder="値段を入力">
    
    @error('price')
        <p class="error-message">{{ $message }}</p>
    @enderror
</div>

        <div class="form-group">
            <div class="label-container">
                <label>商品画像</label>
                <span class="required-tag">必須</span>
            </div>
            <input type="file" name="image">
            @error('image')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <div class="label-container">
                <label>季節</label>
                <span class="required-tag">必須</span>
                <span class="optional-text">複数選択可</span>
            </div>
            <div class="checkbox-group">
                <label><input type="checkbox" name="seasons[]" value="1" {{ is_array(old('seasons')) && in_array('1', old('seasons')) ? 'checked' : '' }}> 春</label>
                <label><input type="checkbox" name="seasons[]" value="2" {{ is_array(old('seasons')) && in_array('2', old('seasons')) ? 'checked' : '' }}> 夏</label>
                <label><input type="checkbox" name="seasons[]" value="3" {{ is_array(old('seasons')) && in_array('3', old('seasons')) ? 'checked' : '' }}> 秋</label>
                <label><input type="checkbox" name="seasons[]" value="4" {{ is_array(old('seasons')) && in_array('4', old('seasons')) ? 'checked' : '' }}> 冬</label>
            </div>
            @error('seasons')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
    <div class="label-container">
        <label>商品説明</label>
        <span class="required-tag">必須</span>
    </div>
    <textarea name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
    
    @error('description')
        <p class="error-message">{{ $message }}</p>
    @enderror
</div>

        <div class="btn-group">
            <a href="{{ route('product.index') }}" class="btn-back">戻る</a>
            <button type="submit" class="btn-submit">登録</button>
        </div>
    </form>
</div>
</body>
</html>