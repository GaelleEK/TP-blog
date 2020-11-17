<?php

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

//require 'C:/Users/acs/code/BlogGrafikart/vendor/autoload.php';
require '../vendor/autoload.php';

define('DEBUG_TIME', microtime(true));

$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();

$router = new App\Router(dirname(__DIR__).'/views');
$router
    -> get('/','post/index','home')
    -> get('/blog/[*:slug]-[i:id]', 'post/show', 'post')
    -> get('/blog/category','category/show','category')
    -> run();

//dd($match['target']);