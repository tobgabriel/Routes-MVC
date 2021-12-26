<?php
    error_reporting(E_ALL);
    ini_set('display_errors', true);
    require dirname(__DIR__,1). '/vendor/autoload.php';

    session_start();
	use app\Router\Route as Route;
    Route::get('/',function(){
    	echo "Hello World";    
    });
    Route::get('ola/{nome}/{idade}',function($nome,$idade){
    	echo "Hello ".$nome.", ".$idade;    
    });
    Route::get('home','Controller@Home');
?>

    
