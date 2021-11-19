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

        flashAdd(['login' => 'E-mail ou senha informados não conferem.']);

        $this->router->redirect('web.login');
    }

    public function register($data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        $validate = new Validate($data);

        $validate->validate([
            'name' => ['required'],
            'email' => ['email', 'unique:user', 'required'],
            'password' => ['min:8', 'required']
        ]);

        if ($errors = $validate->errors()) {
            
            flashAdd($errors);

            $this->router->redirect('web.register');
        }

        $user = new User();
        
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->is_admin = 0;

        if ($user->save()) {
            
            flashAdd(['register' => 'Bem vindo! Agora só falta fazer o login.'], 'success');
            
        } else {

            flashAdd(['register' => 'Falha ao fazer o cadastro.']);
        }

        $this->router->redirect('web.register');

    }
    // tenho que criar um metodo separado para fazer o update das notas
    public function registerNote($data): void
    {
        $this->requiredSession();

        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        $validate = new Validate($data);

        $validate->validate([
            'title' => ['required'],
            'content' => ['required']
        ]);

        if ($errors = $validate->errors()) {
            // salvar no arquivo de log
            flashAdd($errors);

            $this->router->redirect('site.home');
        }

        if (empty($data['id'])) {

            $note = new Note();

            $note->title = $data['title'];
            $note->content = $data['content'];
            $note->user = Login::user()->id;

            $belongs_to = $note->user;

        } else {

            $note = Note::find(['id' => $data['id']])->first();
            
            if (!$note) $this->router->redirect('site.home'); // salvar no arquivo de log

            $note->title = $data['title'];
            $note->content = $data['content'];

            $belongs_to = $note->user;
        }

        if ($belongs_to === Login::user()->id && $note->save())
            flashAdd(['add_note' => 'Nota salva com sucesso.'], 'success');
        else
            flashAdd(['add_note' => 'Erro ao salvar a nota.']);

        $this->router->redirect('site.home');
    }

    public function updateName($data)
    {
        $this->requiredSession();

        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        if (!empty($data['name'])) {

            $user = Login::user();

            $user->name = $data['name'];

            if ($user->save())
                flashAdd(['update_profile' => 'Nome atualizado.'], 'success');
            else
                flashAdd(['update_profile' => 'Erro ao atualizar o nome.']);
        }

        $this->router->redirect('site.profile');
    }

    public function updateEmail($data)
    {
        $this->requiredSession();

        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        if (!empty($data['email'])) {

            $user = Login::user();

            $user->email = $data['email'];

            if ($user->save())
                flashAdd(['update_profile' => 'E-mail atualizado.'], 'success');
            else
                flashAdd(['update_profile' => 'Erro ao atualizar o e-mail.']);
        }

        $this->router->redirect('site.profile');
    }

    public function updatePassword($data)
    {
        $this->requiredSession();

        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        if (!empty($data['old_password']) && !empty($data['new_password'])) {

            $user = Login::user();

            if (!password_verify($data['old_password'], $user->password)) {

                flashAdd(['update_profile' => 'Erro ao atualizar a senha.']);

                $this->router->redirect('site.profile');

            }

            $user->password = password_hash($data['new_password'], PASSWORD_DEFAULT);

            if ($user->save())
                flashAdd(['update_profile' => 'Senha atualizada.'], 'success');
            else
                flashAdd(['update_profile' => 'Erro ao atualizar a senha.']);

        }

        $this->router->redirect('site.profile');
    }

    public function logout(): void
    {
        if (Login::logout())
            $this->router->redirect('web.login');
    }

    protected function requiredSession()
    {
        if (!Login::check()) {
            $this->router->redirect('web.login');
        }
    }
}