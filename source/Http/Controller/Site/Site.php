<?php

namespace Source\Http\Controller\Site;

use Source\Model\Note;
use CoffeeCode\Router\Router;
use Source\Http\Controller\Controller;
use Source\Model\Login;

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
        $notes = (new Note())->find()->object();

        echo $this->blade->render('site.home', [
            'notes' => $notes
        ]);
    }
}

