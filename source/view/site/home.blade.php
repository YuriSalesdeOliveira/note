<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ assets('site/asset/css/main.min.css') }}">
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
                    <a href="{{ $router->route('site.profile') }}" class="profile_dropdown_item">Perfil</a>
                    <a href="{{ $router->route('auth.logout') }}" class="profile_dropdown_item">Sair</a>
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

        @if ($notes)
            @foreach ($notes as $note)
            
                <div class="notes_item" data-note_id="{{ $note->id }}" data-note_color_id="{{ $note->color()->id ?? null}}"
                    style="color:{{ $note->color()->color }};background-color:{{ $note->color()->background_color }};">
                    
                    <div class="notes_item_title">{{ $note->title }}</div>
                    <div class="notes_item_content">{{ $note->content }}</div>
                    <div class="notes_item_create_data">{{ strftime('%A, %d de %B de %Y', strtotime($note->created_at)); }}</div>
                    <a href="{{ $router->route('auth.deleteNote', ['note_id' => $note->id]) }}" class="notes_item_delete">x</a>

                </div>

            @endforeach
        @endif

    </main>

    <div class="modal_container">

        <div class="modal_add_note">

            <form action="{{ $router->route('auth.createOrUpdateNote') }}" method="post">

                <input type="text" name="title" placeholder="Titulo">
    
                <textarea name="content" cols="30" rows="10" placeholder="Conteúdo"></textarea>

                <div class="modal_add_note_actions">

                    <div class="color_note">

                        @if ($colors)
                            @foreach ($colors as $key => $color)
                            
                            <input type="radio" id="{{ $color->id }}"
                                data-color_color="{{ $color->color }}"
                                data-color_background_color="{{ $color->background_color }}"
                                name="color" value="{{ $color->id }}" {{ $key === 0 ? 'checked' : null }}>

                            <label for="{{ $color->id }}"
                                style="background-color: {{ $color->background_color }};"></label>

                            @endforeach
                        @endif

                    </div>

                    <button type="submit">
                        <i class='bx bxs-save'></i>
                    </button>

                </div>

            </form>

        </div>
        
    </div>
    
    <script src="{{ assets('site/asset/js/modal.min.js') }}"></script>
    <script src="{{ assets('site/asset/js/dropdown.min.js') }}"></script>
    <script src="{{ assets('site/asset/js/note.min.js') }}"></script>

</body>
</html>