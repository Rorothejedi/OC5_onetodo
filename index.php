<?php
namespace App;

	// Autoloader
	require 'model/Autoloader.php';
	\App\model\Autoloader::register();

	// Vérification de l'existence de la session
	if(session_id() == "") session_start();

	// Vérification de l'existence d'un cookie pour la connexion automatique
	if(isset($_COOKIE['auth']) && !isset($_SESSION['user_id']))
	{
		$auth = htmlspecialchars($_COOKIE['auth']);
		$auth = explode('---', $auth);
		$user = \App\model\App::getDb()->prepare('SELECT * FROM user WHERE id = ?', [$auth[0]], true, true, false);
		$key = sha1($user->username . $user->password . $_SERVER['REMOTE_ADDR']);
		// Correspondance entre la key de la bdd et celle du cookie 
		if ($key == $auth[1]) 
		{
			$_SESSION['user_id']       = $user->id;
			$_SESSION['user_username'] = $user->username;
			setcookie('auth', $user->id . '---' . $key, time() + 3600 * 24 * 365, null, null, false, true);
		}
		else
		{
			setcookie('auth', '', time() - 3600, null, null, false, true);
		}
	}

	// Instanciation du routeur
	$router = new model\router\Router($_GET['url']);

	// Router get
	// -- Partie publique
	$router->get('/', "Public#displayHome");
	$router->get('/connexion', "Public#displayConnection");
	$router->get('/inscription', "Public#displayRegistration");
	$router->get('/mentions_legales', "Public#displayLegal");
	$router->get('/contact', "Public#displayContact");
	$router->get('/confirmation_inscription', "Public#displayConfirmRegistration");
	$router->get('/validation_inscription', "Public#displayValidationRegistration");
	$router->get('/mot_de_passe_oublie', "Public#displayForgottenPassword");
	$router->get('/nouveau_mot_de_passe', "Public#displayNewPassword");

	// -- Partie privée
	$router->get('/dashboard', "Private#displayDashboard");
	$router->get('/parametres', "Private#displayUserSettings");

	$router->get('/messagerie', "Private#displayMessaging");
	$router->get('/messagerie/talk', "Private#displayMessagingTalk");
	$router->get('/newConversation', "Private#newConversation");
	$router->get('/addUserConversation', "Private#addUserConversation");
	$router->get('/deleteUserConversation', "Private#processDeleteUserConversation");
	
	$router->get('/disconnect', "Private#disconnect");

	// -- Partie projet


	// Router post
	// -- Partie publique
	$router->post('/processContact', "Public#processContact");
	$router->post('/processRegistration', "Public#processRegistration");
	$router->post('/processConnexion', "Public#processConnexion");
	$router->post('/processForgottenPassword', "Public#processForgottenPassword");
	$router->post('/processNewPassword', "Public#processNewPassword");

	// -- Partie privée
	$router->post('/processEditUser', "Private#processEditUser");
	$router->post('/processNewMessage', "Private#processNewMessage");




	//Route execution
	$router->run(); 