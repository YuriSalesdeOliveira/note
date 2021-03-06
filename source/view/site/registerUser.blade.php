<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ assets('site/asset/css/forms.min.css') }}">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Aplicativo de notas - registrar</title>
</head>
<body centralize>
    <div class="register_card">
        <div class="card_header">

            Notes |<span>Cadastrar</span>

        </div>
        <div class="card_body" centralize>

            <form action="{{ $router->route('auth.registerUser') }}" method="post">
    
                @if ($error = flashGet('error', 'registerUser'))
                    <div class="message highlight-error">
                        {{ $error }}
                    </div>
                @endif
                @if ($success = flashGet('success', 'registerUser'))
                    <div class="message highlight-success">
                        {{ $success }}
                    </div>
                @endif


                <div class="form_item">
                    <label for="name">Nome</label>
                    <input type="text" name="name">

                    <div class="message lowlight-error">
                        {{ flashGet('error', 'name') }}
                    </div>
                </div>

                <div class="form_item">
                    <label for="email">E-mail</label>
                    <input type="text" name="email">

                    <div class="message lowlight-error">
                        {{ flashGet('error', 'email') }}
                    </div>
                </div>
        
                <div class="form_item">
                    <label for="password">Senha</label>
                    <input type="password" name="password">

                    <div class="message lowlight-error">
                        {{ flashGet('error', 'password') }}
                    </div>
                </div>
        
                <button type="submit">Cadastrar</button>
        
            </form>

            <div class="button_link_container">
                <a href="{{ $router->route('web.forget') }}" class="button_link">esqueci a senha</a> |
                <a href="{{ $router->route('web.login') }}" class="button_link">fazer login</a>
            </div>


        </div>
        <div class="card_footer">
            Copyright ?? 2021 Notes
        </div>
    </div>
</body>
</html>