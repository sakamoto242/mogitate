<?php $__env->startSection('content'); ?>
<style>
    /* 全体を中央に寄せるレイアウト */
    .verify-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 70vh; /* 画面中央に配置するための高さ */
        text-align: center;
        font-family: 'Inter', sans-serif;
    }

    /* メッセージテキスト */
    .verify-message {
        font-size: 18px;
        font-weight: bold;
        line-height: 1.6;
        margin-bottom: 40px;
        color: #333;
    }

    /* 認証はこちらからボタン（グレーの枠線・背景） */
    .btn-verify-gray {
        display: inline-block;
        background-color: #e0e0e0; /* 薄いグレー */
        color: #333;
        padding: 12px 60px;
        border: 1px solid #999;
        border-radius: 8px;
        font-size: 18px;
        font-weight: bold;
        text-decoration: none;
        cursor: pointer;
        margin-bottom: 30px;
        transition: background-color 0.2s;
    }

    .btn-verify-gray:hover {
        background-color: #d0d0d0;
        color: #333;
    }

    /* 再送リンク */
    .resend-link {
        background: none;
        border: none;
        color: #007bff;
        text-decoration: underline;
        font-size: 14px;
        cursor: pointer;
        padding: 0;
    }

    /* 成功メッセージのポップアップ（もしあれば） */
    .alert-success {
        position: fixed;
        top: 100px;
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
    }
</style>

<div class="verify-wrapper">
    
    <p class="verify-message">
        登録していただいたメールアドレスに認証メールを送信しました。<br>
        メール認証を完了してください。
    </p>

    
    <?php if(session('resent')): ?>
        <div class="alert alert-success" role="alert">
            新しい確認リンクが送信されました。
        </div>
    <?php endif; ?>

    
<a href="http://localhost:8025" target="_blank" class="btn-verify-gray" style="text-decoration: none;">
    認証はこちらから
</a>

    
    <form method="POST" action="<?php echo e(route('verification.resend')); ?>">
        <?php echo csrf_field(); ?>
        <button type="submit" class="resend-link">
            認証メールを再送する
        </button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/auth/verify.blade.php ENDPATH**/ ?>