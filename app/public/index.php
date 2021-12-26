<?php

	require_once 'bootstrap.php';
	
	use app\Router\Route as Route;
	
	$request= new app\Router\Request();

	Route::find($request);

