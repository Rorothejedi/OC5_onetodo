<?php

	//Autoloader
	require 'model/Autoloader.php';
	Autoloader::register();

	// Router
	$router = new Router($_GET['url']);
	$router->get('/', "Public#displayHome");
	$router->get('/dashboard', function(){ echo "Dashboard"; });
	$router->get('/connexion', "Public#displayConnection");
	$router->get('/inscription', "Public#displayRegistration");
	$router->get('/mentions_legales', "Public#displayLegal");



	//Route execution
	$router->run(); 