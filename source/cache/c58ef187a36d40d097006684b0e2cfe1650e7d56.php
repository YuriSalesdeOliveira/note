<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo e(assets('site/asset/css/style.min.css')); ?>">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Aplicativo de notas - perfil</title>
</head>
<body>
    <header class="main_header">

        <div class="main_header_logo">
            Notes
        </div>

        <div class="main_header_actions">

            <a class="main_header_actions_button" href="<?php echo e($router->route('site.home')); ?>">
                <i class='bx bx-left-arrow-alt'></i>voltar
            </a>

            <div class="profile">
                <i class='bx bx-dots-vertical-rounded profile_dropdown_button'></i>

                <nav class="profile_dropdown">
                    <a href="<?php echo e($router->route('site.profile')); ?>" class="profile_dropdown_item">Perfil</a>
                    <a href="<?php echo e($router->route('auth.logout')); ?>" class="profile_dropdown_item">Sair</a>
                </nav>
            </div>

        </div>

    </header>

    <div class="title">
        <span>Perfil
            <i class='bx bx-play'></i>
        </span>
    </div>

    <main class="profile">

        <nav class="forms_nav">

            <a href="javascript:" data-form_id="alter_name" class="forms_nav_item">Alterar nome</a>
            <a href="javascript:" data-form_id="alter_email" class="forms_nav_item">Alterar e-mail</a>
            <a href="javascript:" data-form_id="alter_password" class="forms_nav_item">Alterar senha</a>

        </nav>

        <div class="forms_container">

            <form action="#" id="alter_name" method="post">
                
                <div class="form_item">
                    <label for="name">Nome</label>
                    <input type="text" name="name">
                </div>

                <div class="form_item_button">
                    <button type="submit">Alterar</button>
                </div>

            </form>

            <form action="#" id="alter_email" method="post">
                
                <div class="form_item">
                    <label for="email">E-mail</label>
                    <input type="text" name="email">
                </div>

                <div class="form_item_button">
                    <button type="submit">Alterar</button>
                </div>

            </form>

            <form action="#" id="alter_password" method="post">

               <div class="form_item">
                    <label for="old_password">Senha atual</label>
                    <input type="password" name="old_password">
               </div>
                
                <div class="form_item">
                    <label for="new_password">Nova senha</label>
                    <input type="password" name="new_password">
                </div>

                <div class="form_item_button">
                    <button type="submit">Alterar</button>
                </div>

            </form>

        </div>

    </main>

    <script src="<?php echo e(assets('site/asset/js/toggleForms.min.js')); ?>"></script>
    <script src="<?php echo e(assets('site/asset/js/dropdown.min.js')); ?>"></script>

</body>
</html><?php /**PATH /var/www/html/note/source/view/site/profile.blade.php ENDPATH**/ ?>