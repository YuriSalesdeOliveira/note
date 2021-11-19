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
        $logged_user_id = Login::user()?->id;

        $notes = Note::find(['user' => $logged_user_id])->object();

        echo $this->blade->render('site.home', [
            'notes' => $notes
        ]);
    }

    public function profile()
    {
        echo $this->blade->render('site.profile', []);
    }
}

