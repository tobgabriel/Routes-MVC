<?php
	require_once 'bootstrap.php';
	$method=$_SERVER['REQUEST_METHOD'];
	$route = $_SERVER['REQUEST_URI'];
	$rt->find($method,$route);