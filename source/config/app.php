<?php

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