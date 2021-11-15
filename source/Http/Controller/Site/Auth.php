<?php

namespace Source\Http\Controller\Site;

use Source\Model\Note;
use Source\Model\Login;
use Source\Support\Validate;
use Source\Http\Controller\Controller;

class Auth extends Controller
{
    public function login($data)
    {
        $data =  filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        $validate = new Validate($data);

        $validate->validate([
            'email' => ['email', 'required'],
            'password' => ['required']
        ]);

        if ($validate->errors()) {

            flashAdd($validate->errors());

            $this->router->redirect('site.login');
        }

        $credentials = [
            'email' => $data['email'],
            'password' => $data['password']
        ];

        if (Login::attempt($credentials)) $this->router->redirect('site.home');

        flashAdd(['login' => 'E-mail ou senha errado.']);

        $this->router->redirect('site.login');
    }

    public function storeNote($data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        $note = new Note();
        $note->title = $data['title'];
        $note->content = $data['content'];

        if ($note->save())
            $this->router->redirect('site.home');

        // erro ao salvar
    }
}