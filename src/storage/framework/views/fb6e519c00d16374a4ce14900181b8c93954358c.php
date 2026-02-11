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
            <a href="<?php echo e(route('product.index')); ?>" class="logo">mogitate</a>
        </div>
    </header>

    <div class="container">
        <nav class="breadcrumb">
            <a href="<?php echo e(route('product.index')); ?>">商品一覧</a> &gt; <span><?php echo e($product->name); ?></span>
        </nav>

        <form action="<?php echo e(route('product.update', $product->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>

            <div class="editor-layout">
                <div class="image-section">
                    <div class="image-preview">
                        <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>">
                    </div>
                    <div class="file-input-wrapper">
                        <input type="file" name="image" id="image-upload">
                        <?php if($errors->has('image')): ?>
                            <?php $__currentLoopData = $errors->get('image'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p class="error-message"><?php echo e($message); ?></p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-group">
                        <label>商品名</label>
                        <input type="text" name="name" value="<?php echo e(old('name', $product->name)); ?>" placeholder="商品名を入力">
                        <?php if($errors->has('name')): ?>
                            <?php $__currentLoopData = $errors->get('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p class="error-message"><?php echo e($message); ?></p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>値段</label>
                        <input type="text" name="price" value="<?php echo e(old('price', $product->price)); ?>" placeholder="値段を入力">
                        <?php if($errors->has('price')): ?>
                            <?php $__currentLoopData = $errors->get('price'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p class="error-message"><?php echo e($message); ?></p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>季節</label>
                        <div class="checkbox-group">
                            <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="seasons[]" value="<?php echo e($season->id); ?>"
                                        <?php echo e(in_array($season->id, old('seasons', $product->seasons->pluck('id')->toArray())) ? 'checked' : ''); ?>>
                                    <?php echo e($season->name); ?>

                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php if($errors->has('seasons')): ?>
                            <?php $__currentLoopData = $errors->get('seasons'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p class="error-message"><?php echo e($message); ?></p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="description-section">
                <label>商品説明</label>
                <textarea name="description" placeholder="商品の説明を入力"><?php echo e(old('description', $product->description)); ?></textarea>
                <?php if($errors->has('description')): ?>
                    <?php $__currentLoopData = $errors->get('description'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p class="error-message"><?php echo e($message); ?></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>

            <div class="action-footer">
                <a href="<?php echo e(route('product.index')); ?>" class="btn-back">戻る</a>
                <button type="submit" class="btn-update">変更を保存</button>
            </div>
        </form>

        <div class="delete-area">
            <form action="<?php echo e(route('product.destroy', $product->id)); ?>" method="POST" onsubmit="return confirm('本当に削除しますか？')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn-delete-icon" title="削除する">
                    <span class="trash-svg-icon">🗑</span> 
                </button>
            </form>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\osaka\contact-form\src\resources\views/products/edit.blade.php ENDPATH**/ ?>