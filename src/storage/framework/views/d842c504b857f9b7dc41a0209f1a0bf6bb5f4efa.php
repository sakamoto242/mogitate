

<?php $__env->startSection('content'); ?>
<style>
    /* 画面全体のレイアウト */
    .profile-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 0 20px;
        font-family: 'Inter', sans-serif;
    }

    .profile-container h2 {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 30px;
    }

    /* プロフィール画像部分 */
    .image-section {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 30px;
        margin-bottom: 40px;
    }

    .image-circle {
        width: 120px;
        height: 120px;
        background-color: #d9d9d9;
        border-radius: 50%;
    }

    .btn-select-image {
        color: #ff5a5f;
        border: 1px solid #ff5a5f;
        padding: 8px 18px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
        font-size: 14px;
    }

    /* 入力フォーム部分 */
    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        font-size: 16px;
    }

    .form-group input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        box-sizing: border-box;
    }

    /* 更新ボタン */
    .btn-update {
        width: 100%;
        background-color: #ff5a5f;
        color: white;
        border: none;
        padding: 16px;
        font-size: 18px;
        font-weight: bold;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 20px;
    }

    .btn-update:hover {
        background-color: #e54e53;
    }
</style>

<div class="profile-container">
    <h2>プロフィール設定</h2>

    <form action="/mypage/profile/update" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        
        <div class="image-section">
    <div class="image-circle" id="preview">
    
    <?php if(auth()->user()->image): ?>
        <img src="<?php echo e(asset('storage/' . auth()->user()->image)); ?>" style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
    <?php endif; ?>
</div>

    <label class="btn-select-image">
        画像を選択する
        <input type="file" name="image" style="display:none;">
    </label>
</div>
<div class="form-group">
    <label>ユーザー名</label>
    <input type="text" name="name" value="<?php echo e(old('name', auth()->user()->name ?? '')); ?>">
</div>



<div class="form-group">
    <label>郵便番号</label>
    <input type="text" 
           name="post_code" 
           id="post_code"
           class="form-control" 
           value="<?php echo e(old('post_code', $user->post_code)); ?>" 
           maxlength="7" 
           placeholder="1234567"
           oninput="this.value = this.value.replace(/[^0-9]/g, '');"> 
    
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
    <input type="text" name="address" value="<?php echo e(old('address', auth()->user()->address)); ?>">
</div>

<div class="form-group">
    <label>建物名</label>
    <input type="text" name="building" value="<?php echo e(old('building', auth()->user()->building)); ?>">
</div>
        <button type="submit" class="btn-update">更新する</button>
    </form>
</div>
<script>
    // input[name="image"] を探して、中身が変わった（ファイルが選ばれた）ら動く
    document.querySelector('input[name="image"]').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('preview');
            // 円の中身を、選んだ画像で上書きする
            preview.innerHTML = `<img src="${e.target.result}" style="width:100%; height:100%; border-radius:50%; object-fit:cover;">`;
        };
        reader.readAsDataURL(file);
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/profile.blade.php ENDPATH**/ ?>