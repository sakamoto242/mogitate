<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* ログイン・登録画面ではヘッダーの要素を隠す */
        <?php if(Route::is('login') || Route::is('register') || Route::is('verification.notice')): ?>
            .navbar .d-flex.align-items-center.justify-content-end,
            .navbar form,
            .navbar .flex-grow-1 {
                display: none !important;
            }
        <?php endif; ?>
    </style>
</head>
<body style="background-color: #fff;">
    <nav class="navbar navbar-expand-md navbar-dark bg-black py-3">
        <div class="container-fluid px-5">
            <div class="d-flex align-items-center w-100">
                
                <div class="d-flex align-items-center" style="min-width: 200px;">
                    <a class="navbar-brand m-0" href="<?php echo e(url('/')); ?>">
                        <img src="<?php echo e(asset('storage/COACHTECHヘッダーロゴ.png')); ?>" alt="COACHTECH" style="height: 32px; width: auto;">
                    </a>
                </div>

                <div class="flex-grow-1"></div>

                
                <div style="width: 100%; max-width: 450px;">
    <form action="<?php echo e(route('product.index')); ?>" method="GET">
        <input type="text" 
               class="form-control" 
               name="keyword" 
               placeholder="なにをお探しですか？" 
               value="<?php echo e($keyword ?? ''); ?>">
    </form>
</div>

                <div class="flex-grow-1"></div>

               
<div class="d-flex align-items-center justify-content-end" style="min-width: 300px;">
    <?php if(auth()->guard()->check()): ?>
        
        <a href="<?php echo e(route('mypage')); ?>" class="nav-link text-white fw-bold me-4">マイページ</a>

        <form action="<?php echo e(route('logout')); ?>" method="POST" class="m-0 me-4">
            <?php echo csrf_field(); ?>
            <button type="submit" class="nav-link text-white fw-bold" style="background: none; border: none; padding: 0;">ログアウト</button>
        </form>
    <?php else: ?>
        <a href="<?php echo e(route('login')); ?>" class="nav-link text-white me-4 fw-bold">ログイン</a>
        
        <a href="<?php echo e(route('register')); ?>" class="nav-link text-white me-4 fw-bold">会員登録</a>
    <?php endif; ?>

    <a href="<?php echo e(route('products.create')); ?>" class="btn btn-light fw-bold px-4">出品</a>
</div>
            </div>
        </div>
    </nav>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</body>
</html><?php /**PATH /var/www/resources/views/layouts/app.blade.php ENDPATH**/ ?>