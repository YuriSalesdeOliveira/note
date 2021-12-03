<?php

namespace Source\Http\Controller\Site;

use Source\Model\Login;
use CoffeeCode\Router\Router;
use Source\Http\Controller\Controller;
use Source\Model\NoteColor;

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

        $colors = NoteColor::find()->object();
        
        echo $this->blade->render('site.home', [
            'notes' => $notes,
            'colors' => $colors
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



