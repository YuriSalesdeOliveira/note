<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo e(assets('site/asset/css/style.min.css')); ?>">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Aplicativo de notas - entrar</title>
</head>
<body centralize>
    <div class="login_card">
        <div class="card_header">

            Notes |<span>Entrar</span>

        </div>
        <div class="card_body" centralize>

            <form action="<?php echo e($router->route('auth.login')); ?>" method="post">
                
                <?php if($error = flashGet('error', 'login')): ?>
                    <div class="message highlight-error">
                        <?php echo e($error); ?>

                    </div>
                <?php endif; ?>
                <?php if($success = flashGet('success', 'login')): ?>
                    <div class="message highlight-success">
                        <?php echo e($success); ?>

                    </div>
                <?php endif; ?>

                <div class="form_item">
                    <label for="email">E-mail</label>
                    <input type="text" name="email">

                    <div class="message lowlight-error">
                        <?php echo e(flashGet('error', 'email')); ?>

                    </div>
                </div>
        
                <div class="form_item">
                    <label for="password">Senha</label>
                    <input type="password" name="password">

                    <div class="message lowlight-error">
                        <?php echo e(flashGet('error', 'password')); ?>

                    </div>
                </div>
        
                <button type="submit">Entrar</button>
        
            </form>

            <div class="button_link_container">
                <a href="<?php echo e($router->route('web.forget')); ?>" class="button_link">esqueci a senha</a> |
                <a href="<?php echo e($router->route('web.register')); ?>" class="button_link">registre-se</a>
            </div>

        </div>
        <div class="card_footer">
            Copyright © 2021 Notes
        </div>
    </div>
</body>
</html><?php /**PATH /var/www/html/note/source/view/site/login.blade.php ENDPATH**/ ?>