<?php

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

require 'C:/Users/acs/code/BlogGrafikart/vendor/autoload.php';
//require 'vendor/autoload.php';

define('DEBUG_TIME', microtime(true));

$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();

$router = new App\Router(dirname(__DIR__).'/views');
$router
    -> get('/blog','post/index','blog')
    -> get('/blog/category','category/show','category')
    -> run();




/*
$router ->map('GET', '/', function (){
    require VIEW_PATH . '/post/index.php';
});

$router ->map('GET', '/blog', function (){
    require VIEW_PATH . '/post/index.php';
});

$router ->map('GET', '/blog/category', function (){
    require VIEW_PATH.'/category/show.php';
});

$match = $router -> match();
$match['target']();


if( is_array($match) && is_callable( $match['target'] ) ) {
    call_user_func_array( $match['target'], $match['params'] );
} else {
    // no route was matched
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
*/