<?php

namespace Source\Http\Controller\Site;

use Source\Model\User;
use Source\Model\Login;
use CoffeeCode\Router\Router;
use Source\Http\Controller\Controller;

class Web extends Controller
{
    public function __construct(Router $router)
    {
        parent::__construct($router);
        
        if (Login::check())
            $this->router->redirect('site.home');
    }

    public function login(): void
    {
        echo $this->blade->render('site.login');
    }

    public function register(): void
    {
        echo $this->blade->render('site.register');
    }

    public function forget(): void
    {
        echo $this->blade->render('site.forget');
    }

    public function recoverPassword($data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        if (empty($_SESSION['forget'])) {

            flashAdd(['forget' => 'Informe seu e-mail para recuperar a senha.']);

            $this->router->redirect('web.forget');
        }

        $error_forget = 'Não foi possivel recuperar. Tente novamente.';

        if (empty($data['email']) || empty($data['forget'])) {

            flashAdd(['forget' => $error_forget]);

            $this->router->redirect('web.forget');
        }

        $user = User::find([
            'id' => $_SESSION['forget'],
            'email' => $data['email'],
            'forget' => $data['forget']
            ])->first();

        if (!$user) {

            flashAdd(['forget' => $error_forget]);

            $this->router->redirect('web.forget');
        }

        $_SESSION['forget_compare'] = $user->id;

        echo $this->blade->render('site.recoverPassword');
    }
}