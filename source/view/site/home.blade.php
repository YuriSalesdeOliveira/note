<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ assets('site/asset/css/style.min.css') }}">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>{{ $title }}</title>
</head>
<body>

    <header class="main_header">

        <div class="main_header_logo">
            <i class='bx bxs-notepad' ></i>
            Notes
        </div>

        <div class="main_header_actions">

            <a href="javascript:">adicionar</a>

            <i class='bx bx-dots-vertical-rounded'></i>

        </div>

    </header>

    <div class="notes">

        @foreach ($notes as $note)
        
            <a href="javascript:">
                <div class="notes_item">
                    <div class="notes_item_content">
                        {{ $note->content }}
                    </div>
                    <div class="notes_item_title">{{ $note->title }}</div>
                </div>
            </a>

        @endforeach

    </div>

    <div class="modal_add_note">
        <form action="{{}}" method="post">

            <input type="text" name="title" placeholder="Titulo">

            <textarea name="content" cols="30" rows="10"></textarea>

        </form>
    </div>
    
</body>
</html>