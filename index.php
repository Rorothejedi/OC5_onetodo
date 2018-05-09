<?php

	//Autoloader loading
	require 'model/Autoloader.php';
	Autoloader::register();

	$router = new Router($_GET['url']);
	$router->get('/', "Public#displayHome");
	$router->get('/dashboard', function(){ echo "Dashboard"; });


	//Execution
	$router->run(); 