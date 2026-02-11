<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品一覧</title>
    <style>
        /* CSS: 見本（2枚目）のデザインを再現 */
body {
background-color: #fcfcfc; /* 真っ白より少しだけグレーに */
}

.main-header {
background-color: #fff;
padding: 15px 0;
border-bottom: 1px solid #eee;
}

.header-container {
max-width: 1200px;
margin: 0 auto;
padding: 0 20px;
}

/* ロゴのスタイル（見本再現） */
.logo {
font-size: 32px;
font-weight: 900;
color: #e3c400; /* もぎたてイエロー */
text-decoration: none;
font-style: italic;
font-family: 'Arial Black', sans-serif;
letter-spacing: -1px;
}


.main-container {
display: flex;
max-width: 1200px;
margin: 40px auto;
gap: 30px;
padding: 0 20px;
}

        /* 左側：サイドバー */
.sidebar {
width: 250px; flex-shrink: 0;
}
.sidebar input[type="text"] {
    width: 100%;
    height: 45px; /* 高さを出す */
    padding: 0 15px;
    border: 1px solid #e0e0e0;
    border-radius: 12px; /* 丸みを強くする */
    box-sizing: border-box;
    outline: none;
    font-size: 14px;
    background-color: #fff;
    margin-bottom: 10px;
}
.sidebar select {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 10px; /* 入力欄と同じ 10px に設定 */
    background-color: white;
    cursor: pointer;
    outline: none;
    /* ブラウザ標準の矢印デザインを少しスッキリさせる場合 */
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
}
.sort-section {
    position: relative;
}

.sort-section::after {
    content: "▼";
    font-size: 10px;
    color: #ccc;
    position: absolute;
    right: 15px;
    top: 45px; /* ラベルの高さに合わせて調整してください */
    pointer-events: none;
}
.btn-search { 
    width: 100%; background-color: #ffcc00; border: none; padding: 12px; border-radius: 5px; cursor: pointer; font-weight: bold; margin-top: 10px; 
    }

.btn-search:hover {
    background-color: #f0c000; /* ホバーで少し暗く */
}

/* 価格順表示のセレクトボックスも丸みを統一 */
.sidebar select {
    width: 100%;
    height: 45px;
    padding: 0 15px;
    border: 1px solid #e0e0e0;
    border-radius: 12px;
    background-color: #fff;
    cursor: pointer;
    outline: none;
    color: #999; /* 見本のように少し薄い色にする */
}

    /* 右側：コンテンツ */
.product-content {
    flex-grow: 1;
    max-width: 900px;
    }
.content-header {
    display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;
    }
.content-header h1 {
    color: #8b4513; margin: 0;
    }
.btn-add {
    background-color:#ff9933 !important;
    color: #888888 !important;               /* 文字をグレーにする */
    border: 2px solid #ff9933 !important;    /* 周りをオレンジの線で囲む */
    padding: 8px 20px;
    text-decoration: none;
    border-radius: 8px;                      /* 角の丸み */
    font-weight: bold;
    font-size: 14px;
    display: inline-block;
    transition: all 0.3s;
    }

        /* グリッド表示 */
.product-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}
.product-card {
    background: #fff;
    border-radius: 5px; /* 角丸は控えめ */
    border: none;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05); /* 柔らかい影 */
}
.product-card img {
    width: 100%;
    height: 180px;      /* 高さを少し高めに固定 */
    object-fit: cover;  /* 画像をトリミングして枠に収める */
    display: block;
}

.product-info {
    padding: 15px;
    border-top: 1px solid #f0f0f0;
    display: flex;
    justify-content: space-between;
}

.pagination-wrapper {
    margin: 40px 0;
    display: flex;
    justify-content: center;
}

.pagination {
    display: flex;
    list-style: none;
    padding: 0;
}

.pagination li {
    margin: 0 5px;
}

.pagination li a,
.pagination li span {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    background-color: transparent; /* 背景を透明に */
    border: none; /* 枠線を消す */
    color: #333 !important;
    font-size: 16px;
    text-decoration: none;
}
.pagination li.active span {
    color: #ffcc00 !important; /* アクティブな数字だけ黄色く */
    font-weight: bold;
}

.pagination li a:hover {
    background-color: #fff9c4;
}
.sort-section {
    margin-top: 30px;
}

.sort-section label {
    display: block;
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
}

/* 商品一覧のタイトル色（見本のような茶色系） */
.content-header h1 {
    font-size: 26px;
    color: #333;
}
.btn-search {
    width: 100%;
    height: 45px;
    background-color: #ffcc00; /* 見本の黄色 */
    color: #000 !important;    /* 文字を確実に黒にする */
    border: none;
    border-radius: 12px;       /* 角を丸く */
    font-weight: bold;
    cursor: pointer;
    margin-top: 10px;
}
.sort-section label {
    display: block;
    font-weight: bold;
    margin-bottom: 15px;
    color: #000 !important;
}

.product-info span:last-child {
    font-weight: bold;
    font-size: 16px;
}

.product-info span:first-child {
    font-size: 16px;
    color: #333;
}

.product-card a {
    text-decoration: none;
    color: inherit;
}

/* 絞り込み条件のタグ表示 */
.search-tag {
    display: inline-flex;
    align-items: center;
    background: #fff;
    border: 1px solid #ffd700;
    border-radius: 20px;
    padding: 5px 15px;
    margin-top: 15px;
    font-size: 13px;
    color: #333;
}

.search-tag .close-icon {
    margin-left: 8px;
    color: #ffd700;
    font-weight: bold;
    text-decoration: none;
    cursor: pointer;
}

    </style>
</head>
<body>


<header class="main-header">
    <div class="header-container">
        <a href="<?php echo e(route('product.index')); ?>" class="logo">mogitate</a>
    </div>
</header>
<div class="content-wrapper" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
    
    <div class="content-header" style="display: flex; justify-content: space-between; align-items: center; margin: 40px 0 20px;">
        <h1 style="color: #000; font-size: 28px;">商品一覧</h1>
        <a href="<?php echo e(route('product.create')); ?>" class="btn-add">+ 商品を追加</a>
    </div>

    <div class="main-container" style="display: flex; gap: 30px;">
       <aside class="sidebar">
    <form action="<?php echo e(route('product.index')); ?>" method="GET">
        <input type="text" name="name" placeholder="商品名で検索" value="<?php echo e(request('name')); ?>">
        <button type="submit" class="btn-search">検索</button>

        <div class="active-filters" style="margin-top: 10px;">
    <?php if(request('sort')): ?>
        <div class="search-tag">
            <?php echo e(request('sort') == 'high' ? '高い順に表示' : '低い順に表示'); ?>

            <a href="<?php echo e(route('product.index', request()->except('sort'))); ?>" class="close-icon">×</a>
        </div>
    <?php endif; ?>
    
    <?php if(request('name')): ?>
        <div class="search-tag">
            「<?php echo e(request('name')); ?>」
            <a href="<?php echo e(route('product.index', request()->except('name'))); ?>" class="close-icon">×</a>
        </div>
    <?php endif; ?>
</div>

        <div class="sort-section" style="margin-top: 40px;">
            <label>価格順で表示</label>
            <select name="sort" onchange="this.form.submit()">
                <option value="" disabled <?php echo e(!request('sort') ? 'selected' : ''); ?>>価格で並べ替え</option>
                <option value="low" <?php echo e(request('sort') == 'low' ? 'selected' : ''); ?>>低い順に表示</option>
                <option value="high" <?php echo e(request('sort') == 'high' ? 'selected' : ''); ?>>高い順に表示</option>
            </select>
        </div>
    </form>
</aside>

        <main class="product-content" style="flex-grow: 1;">
            <div class="product-grid">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="product-card">
                       <a href="<?php echo e(route('product.edit', $product->id)); ?>">
                            <img src="/storage/<?php echo e($product->image); ?>" alt="<?php echo e($product->name); ?>">
                            <div class="product-info">
                                <span><?php echo e($product->name); ?></span>
                                <span>¥<?php echo e(number_format($product->price)); ?></span>
                            </div>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </main>
    </div>
</div>

<div class="pagination-wrapper">
    <?php echo e($products->appends(request()->query())->links()); ?>

</div>

</body>
</html><?php /**PATH C:\Users\osaka\contact-form\src\resources\views/products/index.blade.php ENDPATH**/ ?>