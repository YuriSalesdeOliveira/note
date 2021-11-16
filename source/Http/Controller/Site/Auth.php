<?php

namespace Source\Http\Controller\Site;

use Source\Model\Note;
use Source\Model\Login;
use Source\Support\Validate;
use Source\Http\Controller\Controller;
use Source\Model\User;

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

        if ($errors = $validate->errors()) {

            flashAdd($errors);

            $this->router->redirect('web.login');
        }

        $credentials = [
            'email' => $data['email'],
            'password' => $data['password']
        ];

        if (Login::attempt($credentials)) $this->router->redirect('site.home');

        flashAdd(['login' => 'E-mail ou senha errado.']);

        $this->router->redirect('web.login');
    }

    public function register($data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        $validate = new Validate($data);

        $validate->validate([
            'name' => ['required'],
            'email' => ['email', 'required'],
            'password' => ['min:8', 'required']
        ]);

        if ($errors = $validate->errors()) {
            
            flashAdd($errors);

            $this->router->redirect('web.register');
        }

        $user = new User();
        
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->is_admin = 0;

        if ($user->save()) {
            
            flashAdd(['register' => 'Bem vindo! Agora só falta fazer o login.'], 'success');
            
        } else {

            flashAdd(['register' => 'Falha ao fazer o cadastro.']);
        }

        $this->router->redirect('web.register');

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

    public function logout(): void
    {
        if (Login::logout())
            $this->router->redirect('web.login');
    }
}