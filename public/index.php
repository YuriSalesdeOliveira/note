<?php

ob_start();
session_start();

use CoffeeCode\Router\Router;

require_once(dirname(__DIR__) . "/vendor/autoload.php");

$router = new Router(SITE['root']);

$router->namespace('Source\Http\Controller\Site');

/**
 * SITE
 */

$router->group(null);

$router->get('/', 'Site:home', 'site.home');

/**
 * AUTH
 */

$router->group('/nota');

$router->post('/', 'Auth:storeNote', 'auth.storeNote');

/**
 * ERROR
 */

$router->group(null);

$router->namespace('Source\Http\Controller');

$router->get('/oops/{errcode}', 'App:error', 'app.error');

/**
 * DISPATCH ROUTER
 */

$router->dispatch();

if ($router->error()) {
    $router->redirect('app.error', ['errcode' => $router->error()]);
}

ob_end_flush();