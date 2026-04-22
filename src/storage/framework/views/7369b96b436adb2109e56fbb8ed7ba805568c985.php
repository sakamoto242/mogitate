<?php $__env->startSection('content'); ?>
<style>
    /* 全体を中央に寄せるレイアウト */
    .login-container {
        max-width: 400px;
        margin: 80px auto;
        font-family: 'Inter', sans-serif;
    }

    /* 「ログイン」タイトル */
    .login-title {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 30px;
        color: #333;
    }

    /* Bootstrapの不要なカード装飾を消す */
    .card {
        border: none;
        background: transparent;
    }
    .card-header {
        display: none;
    }

    /* 各入力項目の間隔 */
    .form-group-custom {
        margin-bottom: 25px;
    }

    /* ラベル（太字） */
    .form-group-custom label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        font-size: 14px;
        color: #333;
    }

    /* 入力欄のデザイン */
    .form-control-custom {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        box-sizing: border-box;
    }

    /* 鮮やかな赤色のログインボタン */
    .btn-login-red {
        width: 100%;
        background-color: #ff5a5f;
        color: white;
        padding: 14px;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        margin-top: 10px;
        transition: opacity 0.2s;
    }

    .btn-login-red:hover {
        opacity: 0.8;
        color: white;
    }

    /* 下部の「会員登録はこちら」リンク */
    .login-footer {
        text-align: center;
        margin-top: 20px;
    }
    .login-footer a {
        color: #007bff;
        text-decoration: none;
        font-size: 14px;
    }
</style>

<div class="login-container">
    <h1 class="login-title">ログイン</h1>

    <div class="card">
        <div class="card-body p-0">
            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>

                
                <div class="form-group-custom">
                    <label>メールアドレス</label>
                    <input id="email" type="email" class="form-control-custom <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" autocomplete="email" autofocus>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span style="color: red; font-size: 12px;"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="form-group-custom">
                    <label>パスワード</label>
                 <input id="password" type="password" class="form-control-custom <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" autocomplete="current-password">
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span style="color: red; font-size: 12px;"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <button type="submit" class="btn-login-red">
                    ログインする
                </button>

                <div class="login-footer">
                    <?php if(Route::has('register')): ?>
                        <a href="<?php echo e(route('register')); ?>">会員登録はこちら</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/auth/login.blade.php ENDPATH**/ ?>