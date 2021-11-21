<?php

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

define('DEVELOPMENT', $_SERVER['SERVER_NAME'] === 'localhost' ? true : false);

define('LANGUAGE', 'pt-br');

if (!DEVELOPMENT) {

    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
}

define('SITE', [
    'root' => 'http://localhost/note/public',
]);

define('PATH', [
    'public' => dirname(dirname(__DIR__)) . '/public',
    'view' => dirname(__DIR__) . '/view',
    'cache' => dirname(__DIR__) . '/cache',
    'language' => dirname(__DIR__) . '/language'
]);

define("DB_CONNECTION_CONFIG", [
    "host" => "db",
    "port" => "3306",
    "dbname" => "notes",
    "charset" => "utf8",
    "username" => "root",
    "password" => "root",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

define('MAIL', [
    'host' => 'smtp.mailtrap.io',
    'username' => '78cb807423bb71',
    'password' => '2f9c95d8fd7349',
    'port' => '2525',
    'from_name' => 'Yuri Oliveira',
    'from_email' => 'yuri_oli@hotmail.com',
]);