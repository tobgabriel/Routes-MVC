<?php
    error_reporting(E_ALL);
    ini_set('display_errors', true);
     
    require __DIR__ . '/vendor/autoloader.php';
     
    use app\Router;

    $rt=new Router();

    $rt->get('home',function(){
    	echo "Hello World";    
    });
     $rt->get('teste/ola-mundo',function(){
    	echo "teste";    
    });
    