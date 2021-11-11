<?php

namespace Source\Http\Controller\Site;

use Source\Model\Note;
use Source\Http\Controller\Controller;
use Psr\Http\Message\ResponseInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ServerRequestInterface;

class Site extends Controller
{
    public function home(ServerRequestInterface $request): ResponseInterface
    {   
        $notes = Note::find()->object();

        $view = $this->blade->render('site.home', [
            'title' => 'Inicio',
            'notes' => $notes
        ]);

        $response = new HtmlResponse($view);
        return $response;
    }
}

