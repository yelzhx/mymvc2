<?php

error_reporting(-1);

use vendor\core\Router;

//$query = ltrim(rtrim($_SERVER["REQUEST_URI"],'/'),'/');
$query = ltrim(rtrim($_SERVER["QUERY_STRING"],'/'),'/');

define('WWW', __DIR__);
define('CORE', dirname(__DIR__) . '/vendor/core');
define('ROOT', dirname(__DIR__));
define('LIBS', dirname(__DIR__) . 'vendor/libs');
define('APP', dirname(__DIR__) . '/app');
define('LAYOUT', 'default');

$ses=array();
require "../vendor/libs/functions.php";
$ses=session_to_array();
require __DIR__ . "/../vendor/autoload.php";
/*spl_autoload_register(function($class){
    $file = ROOT . '/' . str_replace('\\','/',$class) . '.php';
    //;$file = APP . "/controllers/$class.php";
    if(is_file($file)){
        require_once $file;
    }
});*/
//session_start();
//print_r($_SESSION);
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)/?(?P<alias>[a-z-]+)?$');

Router::dispatch($query);

