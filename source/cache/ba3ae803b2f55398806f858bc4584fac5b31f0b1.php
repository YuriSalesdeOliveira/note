<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo e(assets('site/asset/css/style.min.css')); ?>">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Aplicativo de notas</title>
</head>
<body>

    <header class="main_header">

        <div class="main_header_logo">
            Notes
        </div>

        <div class="main_header_actions">

            <a class="main_header_actions_button add_note_button" href="javascript:">
                <i class='bx bx-add-to-queue' ></i>adicionar
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
        <span>Recentes
            <i class='bx bx-play'></i>
        </span>
    </div>

    <main class="notes">

        <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
            <div class="notes_item" data-note_id="<?php echo e($note->id); ?>">
                <div class="notes_item_title"><?php echo e($note->title); ?></div>
                <div class="notes_item_content"><?php echo e($note->content); ?></div>
                <div class="notes_item_create_data"><?php echo e(strftime('%A, %d de %B de %Y', strtotime($note->created_at))); ?></div>
                <a href="<?php echo e($router->route('auth.deleteNote', ['note_id' => $note->id])); ?>" class="notes_item_delete">x</a>
            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </main>

    <div class="modal_container">

        <div class="modal_body">

            <div class="modal_add_note">

                <form action="<?php echo e($router->route('auth.createOrUpdateNote')); ?>" method="post">
    
                    <input type="text" name="title" placeholder="Titulo">
        
                    <textarea name="content" cols="30" rows="10" placeholder="Conteúdo"></textarea>
    
                    <div class="modal_add_note_actions">
    
                        <button type="submit">
                            <i class='bx bxs-save'></i>
                        </button>
    
                    </div>
    
                </form>
    
            </div>

        </div>
        
    </div>
    
    <script src="<?php echo e(assets('site/asset/js/modal.min.js')); ?>"></script>
    <script src="<?php echo e(assets('site/asset/js/dropdown.min.js')); ?>"></script>
    <script src="<?php echo e(assets('site/asset/js/note.min.js')); ?>"></script>

</body>
</html><?php /**PATH /var/www/html/note/source/view/site/home.blade.php ENDPATH**/ ?>