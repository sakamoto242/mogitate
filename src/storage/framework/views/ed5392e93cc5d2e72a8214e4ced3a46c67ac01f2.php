

<?php $__env->startSection('content'); ?>
<style>
    /* 全体のコンテナ */
    .mypage-container { 
        max-width: 1000px; 
        margin: 0 auto; 
        padding: 40px 20px; 
    }
    
    /* ユーザー情報セクション */
    .user-info { 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        gap: 40px; 
        margin-bottom: 60px; 
    }
    
    .user-icon-wrapper { 
        width: 120px; 
        height: 120px; 
        border-radius: 50%; 
        overflow: hidden; 
        background: #d9d9d9; 
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .user-icon-wrapper img { 
        width: 100%; 
        height: 100%; 
        object-fit: cover; 
    }

    .user-name { 
        font-size: 28px; 
        font-weight: bold; 
        margin: 0;
    }

    .btn-edit-profile { 
        border: 1px solid #ff5a5f; 
        color: #ff5a5f; 
        padding: 8px 24px; 
        border-radius: 4px; 
        text-decoration: none; 
        font-weight: bold; 
        transition: 0.2s;
    }

    .btn-edit-profile:hover {
        background: #fff5f5;
    }

    /* タブセクション */
    .tab-menu-wrapper {
        width: 100vw;
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        border-bottom: 2px solid #ddd;
        margin-bottom: 30px;
    }

    .tab-menu { 
        display: flex; 
        gap: 40px; 
        max-width: 1000px; 
        margin: 0 auto;
        padding: 0 20px;
    }

    .tab-item { 
        padding-bottom: 12px; 
        cursor: pointer; 
        color: #888; 
        font-weight: bold; 
        text-decoration: none; 
        font-size: 16px;
        margin-bottom: -2px;
        border-bottom: 3px solid transparent;
    }

    .tab-item.active { 
        color: #ff5a5f; 
        border-bottom: 3px solid #ff5a5f; 
    }

    /* 商品グリッド */
    .product-grid { 
        display: grid; 
        grid-template-columns: repeat(4, 1fr); 
        gap: 20px; 
        margin-top: 20px;
    }

    .product-item {
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .product-image-container {
        position: relative;
        width: 100%;
        aspect-ratio: 1/1;
        background: #eee;
        overflow: hidden;
    }

    .product-image-container img { 
        width: 100%; 
        height: 100%; 
        object-fit: cover; 
    }

    .product-name { 
        margin-top: 10px; 
        font-size: 15px; 
        text-align: left;
    }

    /* SOLDラベルのコンテナ */
    .sold-tag-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 80px;
        height: 80px;
        z-index: 10;
    }

    /* 赤い三角形 */
    .sold-tag {
        position: absolute;
        top: 0;
        left: 0;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 80px 80px 0 0;
        border-color: #ff4d4f transparent transparent transparent;
    }

    /* 文字の位置と回転 */
    .sold-text {
        position: absolute;
        top: 15px; 
        left: 5px;
        color: white;
        font-size: 14px;
        font-weight: bold;
        transform: rotate(-45deg);
        display: block;
        width: 60px;
        text-align: center;
        z-index: 11;
    }

    @media (max-width: 768px) {
        .product-grid { grid-template-columns: repeat(2, 1fr); }
        .user-info { flex-direction: column; gap: 20px; }
    }
</style>

<div class="mypage-container">
    
    <div class="user-info">
        <div class="user-icon-wrapper">
            <?php if($user->image): ?>
                <img src="<?php echo e(asset('storage/' . $user->image)); ?>" alt="ユーザーアイコン">
            <?php else: ?>
                <div style="color: #999; font-size: 12px;">No Image</div>
            <?php endif; ?>
        </div>
        <h1 class="user-name"><?php echo e($user->name); ?></h1>
        <a href="<?php echo e(route('profile.edit')); ?>" class="btn-edit-profile">プロフィールを編集</a>
    </div>

    
    <div class="tab-menu-wrapper"> 
        <div class="tab-menu">
            <a href="<?php echo e(route('mypage', ['tab' => 'sell'])); ?>" 
               class="tab-item <?php echo e($tab === 'sell' ? 'active' : ''); ?>">
                出品した商品
            </a>
            <a href="<?php echo e(route('mypage', ['tab' => 'buy'])); ?>" 
               class="tab-item <?php echo e($tab === 'buy' ? 'active' : ''); ?>">
                購入した商品
            </a>
        </div>
    </div>

    
    <div class="product-grid">
        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('product.show', ['id' => $product->id])); ?>" class="product-item">
                <div class="product-image-container">
                    <img src="<?php echo e(asset('storage/' . $product->image_url)); ?>" alt="<?php echo e($product->name); ?>">
                    
                    
                    <?php if($product->buyer_id): ?>
                        <div class="sold-tag-container">
                            <div class="sold-tag"></div>
                            <span class="sold-text">SOLD</span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="product-name"><?php echo e($product->name); ?></div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div style="grid-column: 1 / -1; padding: 100px 0; color: #888; text-align: center;">
                表示する商品がありません
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/mypage.blade.php ENDPATH**/ ?>