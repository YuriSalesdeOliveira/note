<?php

require_once(dirname(__DIR__) . "/vendor/autoload.php");

use IPub\SlimRouter\Routing\Router;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

$request = ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$router = new Router();

$router->setBasePath(SITE['base']);

$router->get('/', 'Source\Http\Controller\Site\Site:home')->setName('site.home');

$response = $router->handle($request);

(new SapiEmitter)->emit($response);
