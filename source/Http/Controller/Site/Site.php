<?php

namespace Source\Http\Controller\Site;

use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Source\Http\Controller\Controller;

class Site extends Controller
{
    public function home(ServerRequestInterface $request): ResponseInterface
    {   
        $view = $this->blade->render('site.home', [
            'title' => 'Inicio'
        ]);

        $response = new HtmlResponse($view);
        return $response;
    }
}

