<?php

ob_start();
session_start();

use CoffeeCode\Router\Router;

require_once(dirname(__DIR__) . "/vendor/autoload.php");

$router = new Router(SITE['root']);

$router->namespace('Source\Http\Controller\Site');

/**
 * WEB
 */

$router->group(null);
$router->get('/entrar', 'Web:login', 'web.login');
$router->get('/cadastrar', 'Web:register', 'web.register');


/**
 * SITE
 */

$router->group(null);
$router->get('/', 'Site:home', 'site.home');
$router->get('/perfil', 'Site:profile', 'site.profile');

/**
 * AUTH
 */

$router->group(null);
$router->post('/entrar', 'Auth:login', 'auth.login');
$router->post('/cadastrar', 'Auth:register', 'auth.register');
$router->get('/sair', 'Auth:logout', 'auth.logout'); // deixei o logout como get, mas ver o post

$router->group('/nota');
$router->post('/', 'Auth:registerNote', 'auth.registerNote');

$router->group('/perfil');
$router->post('/editar/nome', 'Auth:updateName', 'auth.updateName');
$router->post('/editar/email', 'Auth:updateEmail', 'auth.updateEmail');
$router->post('/editar/senha', 'Auth:updatePassword', 'auth.updatePassword');

/**
 * ERROR
 */

$router->namespace('Source\Http\Controller');

$router->group(null);
$router->get('/oops/{errcode}', 'App:error', 'app.error');

/**
 * DISPATCH ROUTER
 */

$router->dispatch();

if ($router->error()) {
    $router->redirect('app.error', ['errcode' => $router->error()]);
}

ob_end_flush();