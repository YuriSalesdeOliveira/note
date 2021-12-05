<?php

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

define('DEVELOPMENT', $_SERVER['SERVER_NAME'] === 'localhost' ? true : true);

define('LANGUAGE', 'pt-br');

if (!DEVELOPMENT) {

    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
}

define('SITE', [
    'name' => 'Notes',
    'root' => 'http://',
]);

define('PATH', [
    'public' => dirname(dirname(__DIR__)) . '/public',
    'view' => dirname(__DIR__) . '/view',
    'cache' => dirname(__DIR__) . '/cache',
    'language' => dirname(__DIR__) . '/language',
    'config' => dirname(__DIR__) . '/config',
    'storage' => dirname(__DIR__) . '/storage'
]);

define("DATA_BASE_CONFIG", [
    'driver' => 'mysql',
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

define('EMAIL_CONFIG', [
    'host' => '',
    'username' => '',
    'password' => '',
    'port' => '',
    'from_name' => '',
    'from_email' => '',
]);

define('TELEGRAM_CONFIG', [
    'bot_token' => '',
    'chat_id' => 0
]);