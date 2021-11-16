<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ assets('site/asset/css/style.min.css') }}">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Aplicativo de notas</title>
</head>
<body>

    <header class="main_header">

        <div class="main_header_logo">
            <i class='bx bxs-notepad' ></i>
            Notes
        </div>

        <div class="main_header_actions">

            <a class="add_note_button" href="javascript:">adicionar</a>

            <div class="profile">
                <i class='bx bx-dots-vertical-rounded profile_dropdown_button'></i>

                <nav class="profile_dropdown">
                    <a href="{{ $router->route('site.profile') }}" class="profile_dropdown_item">Perfil</a>
                    <a href="{{ $router->route('auth.logout') }}" class="profile_dropdown_item">Sair</a>
                </nav>
            </div>

        </div>

    </header>

    <div class="notes">

        @foreach ($notes as $note)
        
            <a href="javascript:" class="notes_item">
                <div class="notes_item_content">
                    {{ $note->content }}
                </div>
                <div class="notes_item_title">{{ $note->title }}</div>
            </a>

        @endforeach

    </div>

    <div class="modal_container">

        <div class="modal_body">

            <div class="modal_add_note">

                <form action="{{ $router->route('auth.storeNote') }}" method="post">
    
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
    
    <script src="{{ assets('site/asset/js/main.min.js') }}"></script>

</body>
</html>