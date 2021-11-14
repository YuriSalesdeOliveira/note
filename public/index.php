<?php

use CoffeeCode\Router\Router;

require_once(dirname(__DIR__) . "/vendor/autoload.php");

$router = new Router(SITE['root']);

$router->namespace('Source\Http\Controller\Site');

/**
 * SITE
 */

$router->get('/', 'Site:home', 'site.home');

/**
 * AUTH
 */

$router->post('/', 'Auth:storeNote', 'auth.storeNote');

/**
 * ERROR
 */

$router->namespace('Source\Http\Controller');

$router->get('/oops/{errcode}', 'App:error', 'app.error');

$router->dispatch();

if ($router->error()) {
    $router->redirect('app.error', ['errcode' => $router->error()]);
}