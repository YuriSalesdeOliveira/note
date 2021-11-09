<?php

define('DEVELOPMENT', $_SERVER['SERVER_NAME'] === 'localhost' ? true : false);

define('SITE', [
    'root' => 'http://localhost/note/public/',
    'base' => '/note/public'
]);

define('PATH', [
    'view' => dirname(__DIR__) . '/view',
    'cache' => dirname(__DIR__) . '/cache',
    'public' => dirname(dirname(__DIR__)) . '/public'
]);