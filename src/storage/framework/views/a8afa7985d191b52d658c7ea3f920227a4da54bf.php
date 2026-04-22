

<?php $__env->startSection('content'); ?>
<style>
    .address-container { max-width: 600px; margin: 60px auto; padding: 0 20px; }
    .page-title { font-size: 24px; font-weight: bold; text-align: center; margin-bottom: 40px; }
    .form-group { margin-bottom: 25px; }
    .form-group label { display: block; font-weight: bold; margin-bottom: 8px; }
    .form-control { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 16px; }
    .btn-update { width: 100%; background: #ff5a5f; color: white; border: none; padding: 15px; border-radius: 4px; font-size: 18px; font-weight: bold; cursor: pointer; margin-top: 20px; }
</style>


<div class="address-container">
    <h1 class="page-title">住所の変更</h1>

    
    <form action="<?php echo e(route('address.update', ['id' => $product->id])); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label>郵便番号</label>
            <input type="text" 
                   name="post_code" 
                   class="form-control"
                   value="<?php echo e(old('post_code', $user->post_code ?? '')); ?>" 
                   maxlength="7" 
                   oninput="value = value.replace(/[^0-9]+/g, '');">

            <?php $__errorArgs = ['post_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div style="color: #ff5a5f; font-size: 14px; margin-top: 5px;"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label>住所</label>
            <input type="text" name="address" class="form-control" 
                   value="<?php echo e(old('address', Auth::user()->address)); ?>" required>
        </div>

        <div class="form-group">
            <label>建物名</label>
            <input type="text" name="building" class="form-control" 
                   value="<?php echo e(old('building', Auth::user()->building)); ?>">
        </div>

        <button type="submit" class="btn-update">更新する</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/products/address.blade.php ENDPATH**/ ?>