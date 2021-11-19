<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo e(assets('site/asset/css/style.min.css')); ?>">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Aplicativo de notas - registrar</title>
</head>
<body centralize>
    <div class="register_card">
        <div class="card_header">

            Notes |<span>Cadastrar</span>

        </div>
        <div class="card_body" centralize>

            <form action="<?php echo e($router->route('auth.register')); ?>" method="post">
    
                <?php if($error = flashGet('error', 'register')): ?>
                    <div class="message highlight-error">
                        <?php echo e($error); ?>

                    </div>
                <?php endif; ?>
                <?php if($message = flashGet('success', 'register')): ?>
                    <div class="message highlight-success">
                        <?php echo e($message); ?>

                    </div>
                <?php endif; ?>


                <div class="form_item">
                    <label for="name">Nome</label>
                    <input type="text" name="name">

                    <div class="message lowlight-error">
                        <?php echo e(flashGet('error', 'name')); ?>

                    </div>
                </div>

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
        
                <button type="submit">Cadastrar</button>
        
            </form>

            <a href="<?php echo e($router->route('web.login')); ?>" class="button_register">fazer login</a>

        </div>
        <div class="card_footer">
            Copyright © 2021 Notes
        </div>
    </div>
</body>
</html><?php /**PATH /var/www/html/note/source/view/site/register.blade.php ENDPATH**/ ?>