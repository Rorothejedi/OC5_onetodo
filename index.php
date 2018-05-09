<?php

	//Autoloader loading
	require 'model/router/RouterAutoloader.php';
	RouterAutoloader::register();

	function __autoload($class_name)
	{
	    require('./model/routeur/' . $class_name . '.php'); 
	}

	$router = new Router($_GET['url']);
	$router->get('/', function(){ echo "Homepage"; });
	$router->get('/dashboard', function(){ echo "Dashboard"; });


	//Execution
	$router->run(); 