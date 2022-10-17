<?php

require_once 'lib/helper.php';

use Core\Router;

ini_set('display_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class. '.php');
    if (file_exists($path)) {
        require $path;
    }
});

session_start();

$router = new Router();
