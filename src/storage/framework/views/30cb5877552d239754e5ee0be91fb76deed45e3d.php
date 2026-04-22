

<?php $__env->startSection('content'); ?>
<style>
    /* 1. 全体を中央に寄せ、適切な幅を持たせる */
    .products-container {
        max-width: 1024px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    /* 2. 画面いっぱいのグレーの線を引くためのラッパー */
    .tab-menu-wrapper {
        width: 100vw;
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        border-bottom: 1px solid #ddd; 
        margin-bottom: 40px;
    }

    .tab-menu {
        display: flex;
        gap: 50px;
        max-width: 1024px;
        margin: 0 auto;
        padding: 0 50px;
    }

    .tab-item {
        text-decoration: none;
        padding-bottom: 15px;
        font-weight: bold;
        font-size: 16px;
        color: #888;
        border-bottom: 3px solid transparent;
        margin-bottom: -1px; 
    }

    .tab-item.active {
        color: #ff5a5f;
        border-bottom: 3px solid #ff5a5f;
    }

    /* 3. 商品グリッドを横4列に固定 */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }

    .product-image-box {
        position: relative;
        aspect-ratio: 1 / 1;
        background-color: #d9d9d9;
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 10px;
    }

    .product-image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-card a {
    text-decoration: none !important; /* 下線を消す */
    color: #333 !important;          /* 文字を黒にする */
}

    .product-name {
        font-size: 15px;
    margin-top: 10px;
    font-weight: 500;
    }
    /* Soldラベルのデザイン */
.sold-label {
    position: absolute;
    top: 0;
    left: 0;
    background: rgba(255, 0, 0, 0.8); /* 赤い半透明 */
    color: white;
    padding: 5px 15px;
    font-weight: bold;
    font-size: 14px;
    z-index: 10;
}
</style>

<div class="products-container">
    
<div class="tab-menu-wrapper">
    <div class="tab-menu">
        
        <a href="<?php echo e(route('product.index', ['keyword' => request('keyword')])); ?>" 
           class="tab-item <?php echo e(!request('page') ? 'active' : ''); ?>">
           おすすめ
        </a>
        
        
        <a href="<?php echo e(route('product.index', ['page' => 'mylist', 'keyword' => request('keyword')])); ?>" 
           class="tab-item <?php echo e(request('page') == 'mylist' ? 'active' : ''); ?>">
           マイリスト
        </a>
    </div>
</div>

    
    <div class="product-grid">
        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="product-card">
        <a href="<?php echo e(route('product.show', $product->id)); ?>" style="text-decoration: none; color: inherit;">
            <div class="product-image-box">
                <?php if($product->image_url): ?>
                    <img src="<?php echo e(asset('storage/' . $product->image_url)); ?>" alt="<?php echo e($product->name); ?>">
                <?php else: ?>
                    <span style="color: #888;">No Image</span>
                <?php endif; ?>

                
                <?php if($product->buyer_id): ?>
                    <div class="sold-label">Sold</div>
                <?php endif; ?>
            </div>
            <p class="product-name"><?php echo e($product->name); ?></p>
        </a>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p style="grid-column: 1 / -1; text-align: center; color: #888; padding: 100px 0;">商品がありません。</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/products/index.blade.php ENDPATH**/ ?>