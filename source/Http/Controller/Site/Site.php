<?php

namespace Source\Http\Controller\Site;

use Source\Http\Controller\Controller;
use Source\Model\Note;

class Site extends Controller
{
    public function login()
    {
        echo $this->blade->render('site.login');
    }

    public function home(): void
    {   
        $notes = (new Note())->find()->object();

        echo $this->blade->render('site.home', [
            'notes' => $notes
        ]);
    }
}

