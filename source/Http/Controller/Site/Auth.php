<?php

namespace Source\Http\Controller\Site;

use Source\Model\Note;
use Source\Model\User;
use Source\Model\Login;
use Source\Support\Email;
use Source\Support\Validate;
use Illuminate\Support\Facades\Log;
use Source\Http\Controller\Controller;

class Auth extends Controller
{
    public function login($data): void
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

    public function registerUser($data): void
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

            $this->router->redirect('web.registerUser');
        }

        $user = new User();
        
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->is_admin = 0;

        if ($user->save()) {
            
            $credentials = [
                'email' => $data['email'],
                'password' => $data['password']
            ];

            if (!Login::attempt($credentials)) {

                logs('auth')->error('registerUser: Houve um erro ao tentar logar depois do cadastro.', [
                    'user' => User::find(['email' => $credentials['email']])->first()
                ]);

                flashAdd(['registerUser' => 'Falha ao tentar logar depois do cadastro.']);
                
                $this->router->redirect('web.registerUser');        
            }
            
            $this->router->redirect('site.home');
            
        } else {

            flashAdd(['registerUser' => 'Falha ao fazer o cadastro.']);
        }

        $this->router->redirect('web.registerUser');

    }
    
    public function createOrUpdateNote($data): void
    {
        $this->requiredSession();

        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        if (empty($data['title']) && empty($data['content'])) $this->router->redirect('site.home');

        if (empty($data['id'])) {

            $note = new Note();

            $note->title = $data['title'];
            $note->content = $data['content'];
            $note->user = Login::user()->id;

            $belongs_to = $note->user;

        } else {

            $note = Note::find(['id' => $data['id']])->first();
            
            if (!$note) {
                
                logs('auth')
                ->critical('createOrUpdateNote: usuário tentou informa id da nota manualmente', [
                    'user' => Login::user()->getAttributes()
                ]);

                $this->router->redirect('site.home');
            }

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

    public function deleteNote($data): void
    {
        $this->requiredSession();

        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        if (!empty($data['note_id']) && $note = Note::find(['id' => $data['note_id']])->first()) {

            if ($note->user === Login::user()->id)
                $note->remove();

        }

        $this->router->redirect('site.home');

    }

    public function updateName($data): void
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

    public function updateEmail($data): void
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

    public function updatePassword($data): void
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

            [$message, $type] = ['Senha atualizada.', 'success'];

            if (!$user->save()) {

                logs('auth')->critical('updatePassword: erro ao tentar salvar usuário no banco', [
                    'PDOException' => [
                        'code' => $user->error()->getCode(),
                        'message' => $user->error()->getMessage()
                    ]
                ]);
                
                [$message, $type] = ['Erro ao atualizar a senha.', 'error'];
            }
            
            flashAdd(['update_profile' => $message], $type);
        }

        $this->router->redirect('site.profile');
    }

    public function forget($data)
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        $validate = new Validate($data);

        $validate->validate([
            'email' => ['required', 'email', 'exists:user']
        ]);

        if ($errors = $validate->errors()) {
            
            flashAdd($errors);

            $this->router->redirect('web.forget');
        }

        $user = User::find(['email' => $data['email']])->first();

        $user->forget = md5(uniqid(rand(), true));
        $user->save();

        $_SESSION['forget'] = $user->id;

        $email = new Email();

        $email->add(
            'Recupere sua senha |' . SITE['name'],
            $this->blade->render('site.email.recover' , [
                'user' => $user
            ]),
            $user->name,
            $user->email
        )->send();

        [$message, $type] = ['Enviamos um link de recuperação para o seu e-mail.', 'success'];

        if ($email->error()) {

            logs('auth')->error('forget: erro ao enviar o email de recuperação de senha', [
                'exception' => [
                    'code' => $email->error()->getCode(),
                    'message' => $email->error()->getMessage()
                ],
                'user' => $user->getAttributes()
            ]);

            [$message, $type] = ['Não foi possivel recuperar. Tente novamente.', 'error'];
        }

        flashAdd(['forget' => $message], $type);

        $this->router->redirect('web.forget');
    }

    public function recoverPassword($data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        $error_forget = 'Não foi possivel recuperar. Tente novamente.';

        if (empty($_SESSION['forget']) || empty($_SESSION['forget_compare'])) {

            flashAdd(['forget' => $error_forget]);

            $this->router->redirect('web.forget');
        }

        if ($_SESSION['forget'] != $_SESSION['forget_compare']
            || !$user = User::find(['id' => $_SESSION['forget']])->first()) {

            flashAdd(['forget' => $error_forget]);

            $this->router->redirect('web.froget');
        }

        $validate = new Validate($data);

        $validate->validate([
            'password' => ['required', 'min:8']
        ]);

        if ($errors = $validate->errors()) {

            flashAdd($errors);

            $this->router->redirect('web.recoverPassword',
                ['email' => $user->email, 'forget' => $user->forget]);
        }

        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->forget = null;

        [$message, $type] = $user->save() ?
        ['Sua senha foi atualizada.', 'success'] :
        [$error_forget, 'error'];

        flashAdd(['login' => $message], $type);

        unset($_SESSION['forget']);
        unset($_SESSION['forget_compare']);

        $this->router->redirect('web.login');
    }

    public function logout(): void
    {
        if (Login::logout())
            $this->router->redirect('web.login');
    }

    protected function requiredSession(): void
    {
        if (!Login::check()) {
            $this->router->redirect('web.login');
        }
    }
}