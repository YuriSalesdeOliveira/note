<?php

namespace Source\Http\Controller\Site;

use CoffeeCode\Router\Router;
use Source\Http\Controller\Controller;
use Source\Model\Login;

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
}