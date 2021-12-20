<?php
    error_reporting(E_ALL);
    ini_set('display_errors', true);
    require dirname(__DIR__,1). '/vendor/autoload.php';

    $rt=new app\Router\Router();
    
    $rt->get('/',function(){
    	echo "Hello World";    
    });
    $rt->get('ola/{nome}/{idade}',function($nome,$idade){
    	echo "Hello ".$nome.", ".$idade;    
    });

    
