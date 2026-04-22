

<?php $__env->startSection('content'); ?>
<div style="max-width: 600px; margin: 100px auto; text-align: center; padding: 0 20px;">
    <h1 style="font-size: 28px; font-weight: bold; margin-bottom: 20px;">ご購入ありがとうございました！</h1>
    <p style="color: #666; margin-bottom: 40px;">
        商品の購入手続きが完了しました。<br>
        出品者からの発送をお待ちください。
    </p>

    <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 40px; text-align: left;">
        <p style="margin: 0;"><strong>購入商品：</strong> <?php echo e($product->name); ?></p>
        <p style="margin: 10px 0 0;"><strong>支払い金額：</strong> ¥<?php echo e(number_format($product->price)); ?></p>
    </div>

    <a href="<?php echo e(route('product.index')); ?>" 
       style="display: inline-block; background: #ff5a5f; color: white; text-decoration: none; padding: 12px 40px; border-radius: 4px; font-weight: bold;">
        トップページへ戻る
    </a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/products/thanks.blade.php ENDPATH**/ ?>