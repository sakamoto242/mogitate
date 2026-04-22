

<?php $__env->startSection('content'); ?>
<style>
    .profile-setup-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        font-family: 'Inter', sans-serif;
    }
    .profile-title {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 30px;
    }
    .form-group { margin-bottom: 25px; }
    .form-group label { display: block; margin-bottom: 8px; font-weight: bold; }
    
    .image-upload-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        margin-bottom: 30px;
    }
    .circle-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background-color: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 1px solid #ddd;
    }
    .btn-upload {
        border: 1px solid #ff5a5f;
        color: #ff5a5f;
        padding: 8px 20px;
        border-radius: 4px;
        background: white;
        cursor: pointer;
        font-weight: bold;
    }
    
    .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    .btn-submit-red {
        width: 100%;
        background-color: #ff5a5f;
        color: white;
        padding: 14px;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        margin-top: 20px;
    }
</style>

<div class="profile-setup-container">
    <h1 class="profile-title">プロフィール設定</h1>
<?php if($errors->any()): ?>
        <div style="color: #ff5a5f; background: #fff5f5; border: 1px solid #ff5a5f; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
            <ul style="margin: 0;">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="<?php echo e(route('profile.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        
<div class="image-upload-section">
    <div class="circle-image" id="image-preview">
        
        <?php if($user->image): ?>
    <img src="<?php echo e(asset('storage/' . $user->image)); ?>" style="width: 100%; height: 100%; object-fit: cover;">
<?php else: ?>
    <span style="color: #999;">No Image</span>
<?php endif; ?>
    </div>
    <input type="file" name="image" id="image" style="display:none;" onchange="previewImage(this)">
    <label for="image" class="btn-upload">画像を選択する</label>
</div>


<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var preview = document.getElementById('image-preview');
            preview.innerHTML = '<img src="' + e.target.result + '" style="width: 100%; height: 100%; object-fit: cover;">';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
        
<div class="form-group">
    <label>ユーザー名</label>
    <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $user->name)); ?>">
</div>



<div class="form-group">
    <label>郵便番号</label>
    <input type="text" 
           name="post_code" 
           class="form-control" 
           value="<?php echo e(old('post_code', $user->post_code)); ?>" 
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
    <input type="text" name="address" class="form-control" value="<?php echo e(old('address', $user->address)); ?>">
</div>


<div class="form-group">
    <label>建物名</label>
    <input type="text" name="building" class="form-control" value="<?php echo e(old('building', $user->building)); ?>">
</div>

        <button type="submit" class="btn-submit-red">更新する</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/profile_setup.blade.php ENDPATH**/ ?>