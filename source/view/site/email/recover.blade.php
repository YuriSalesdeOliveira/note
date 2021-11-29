<div style="width: 500px; max-width: 100%;
    padding: 10px; font-family: 'Trebuchet MS', sans-serif; font-size: 1.2em;">

    <h4>Presado(a) <?= $user->name; ?>,</h4>
    <p>Recebemos em nosso site uma solicitação para recuperar sua senha, por favor,
        caso não tenha solicitado ignore este e-mail. Caso contrário...</p>
    <p>
        <a href="{{ $router->route('web.recoverPassword', ['email' => $user->email, 'forget' => $user->forget]) }}"
            title="Recuperar Senha">CLIQUE AQUI PARA RECUPERAR SUA SENHA</a>
    </p>
    <p>Atenciosamente {{ SITE['name'] }}</p>

</div>