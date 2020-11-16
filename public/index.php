<?php

require 'C:/Users/acs/code/BlogGrafikart/vendor/autoload.php';
//require 'vendor/autoload.php';

$router = new AltoRouter();

define('VIEW_PATH', dirname(__DIR__).'/views');

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

/*
if( is_array($match) && is_callable( $match['target'] ) ) {
    call_user_func_array( $match['target'], $match['params'] );
} else {
    // no route was matched
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
*/