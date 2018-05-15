<?php
namespace App;

	// Vérification de l'existence de la session
	if(session_id() == "") session_start();

	//Autoloader
	require 'model/Autoloader.php';
	\App\model\Autoloader::register();

	// Router
	$router = new model\router\Router($_GET['url']);
	$router->get('/', "Public#displayHome");
	$router->get('/dashboard', "Private#displayDashboard");
	$router->get('/connexion', "Public#displayConnection");
	$router->get('/inscription', "Public#displayRegistration");
	$router->get('/mentions_legales', "Public#displayLegal");
	$router->get('/confirmation_inscription', "Public#displayConfirmRegistration");
	$router->get('/validation_inscription', "Public#displayValidationRegistration");



	$router->post('/processRegistration', "Public#processRegistration");



	//Route execution
	$router->run(); 