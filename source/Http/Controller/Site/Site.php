<?php

namespace Source\Http\Controller\Site;

use Source\Model\Login;
use Source\Support\Log;
use CoffeeCode\Router\Router;
use Source\Http\Controller\Controller;

class Site extends Controller
{
    public function __construct(Router $router)
    {
        parent::__construct($router);

        if (!Login::check())
            $this->router->redirect('web.login');
    }

    public function home(): void
    {
        $notes = Login::user()->notes();
        
        echo $this->blade->render('site.home', [
            'notes' => $notes
        ]);
    }

    public function profile()
    {
        $user = Login::user();

        echo $this->blade->render('site.profile', [
            'user' => $user
        ]);
    }
}

