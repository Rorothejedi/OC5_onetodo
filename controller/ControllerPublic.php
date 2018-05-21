<?php 
namespace App\controller;

/**
 * Class ControllerPublic
 * Controller qui gère les views et les models de la partie public du site (page d'accueil, de connexion, d'inscription et les mentions légales).
 */
class ControllerPublic extends Alert
{
	/**
	 * Méthode d'affichage de la page d'accueil.
	 */
	public function displayHome()
	{
		require('./view/viewPublic/viewHome.php');
	}

	/**
	 * Méthode d'affichage de la page des mentions légales.
	 */
	public function displayLegal()
	{
		require('./view/viewPublic/viewLegal.php');
	}

	/**
	 * Méthode d'affichage de la page de connexion.
	 */
	public function displayConnection()
	{
		require('./view/viewPublic/viewConnection.php');
	}

	/**
	 * Méthode d'affichage de la page d'inscription.
	 */
	public function displayRegistration()
	{
		require('./view/viewPublic/viewRegistration.php');
	}

	/**
	 * Méthode d'affichage de la page de confirmation de l'inscription.
	 */
	public function displayConfirmRegistration()
	{
		require('./view/viewPublic/viewConfirmRegistration.php');
	}

	/**
	 * Méthode d'affichage de la page de mot de passe oublié.
	 */
	public function displayForgottenPassword()
	{
		require('./view/viewPublic/viewForgottenPassword.php');
	}

	/**
	 * Méthode d'affichage de la page de réinitialisation du mot de passe utilisateur. Vérification de la validité des informations avant l'accès à la page 'nouveau_mot_de_passe' par un utilisateur.
	 */
	public function displayNewPassword()
	{
		if (isset($_GET['username']) && !empty($_GET['username'])
			&& isset($_GET['key']) && !empty($_GET['key']))
		{
			$username = htmlspecialchars($_GET['username']);
			$token    = htmlspecialchars($_GET['key']);

			$user        = new \App\model\User(['username' => $username]);
			$userManager = new \App\model\UserManager();
			$courentUser = $userManager->getUser($user);

			if ($courentUser->token() == $token) 
			{
				require('./view/viewPublic/viewNewPassword.php');
			}
			else
			{
				$this->alert_failure('Les données transmises ne correspondent pas aux données de l\'utilisateur', 'mot_de_passe_oublie');
			}
		}
		else
		{
			$this->alert_failure('Les données transmises ne sont pas valides', 'mot_de_passe_oublie');
		}
	}

	/**
	 * Méthode d'affichage et de traitement des données de la page de validation de l'inscription avec gestion des erreurs.
	 * Récupère les données en GET (username et key) pour vérifier la concordance avec celles de la base de données. Si elles sont conforment, le compte de l'utilisateur est validé.
	 */
	public function displayValidationRegistration()
	{
		if (isset($_GET['username']) && !empty($_GET['username'])
			&& isset($_GET['key']) && !empty($_GET['key']))
		{
			$username = htmlspecialchars($_GET['username']);
			$token    = htmlspecialchars($_GET['key']);

			$user        = new \App\model\User(['username' => $username]);
			$userManager = new \App\model\UserManager();
			$courentUser = $userManager->getUser($user);

			if ($courentUser->confirm_register() === 0)
			{
				if ($token == $courentUser->token()) 
				{
					$userManager->validateUser($user);
					require('./view/viewPublic/viewValidationRegistration.php');
				}
				else
				{
					$this->alert_failure('Erreur ! Votre compte ne peut pas être activé', './');
				}
			}
			else
			{
				$this->alert_success('Votre compte est déjà actif');
				header('Location: ./connexion');
				exit;
			}
		}
		else
		{
			$this->alert_failure('Les données transmises ne sont pas valides', './');
		}
	}

	/**
	 * Permet la gestion des données d'inscription (récupération, traitement, transformation) avec une gestion des erreurs
	 * Une fois les données traitées, elles sont enregistrées dans la base de données. Un mail est envoyé à l'adresse mail indiquée et l'utilisateur et redirigé vers la page de confirmation de l'inscription.
	 */
	public function processRegistration()
	{
		if (isset($_POST['username']) && !empty($_POST['username']) 
			&& isset($_POST['email']) && !empty($_POST['email']) 
			&& isset($_POST['password']) && !empty($_POST['password']) 
			&& isset($_POST['confirm_password']) && !empty($_POST['confirm_password'])) 
		{
			$username         = htmlspecialchars($_POST['username']);
			$email            = htmlspecialchars($_POST['email']);
			$password         = htmlspecialchars($_POST['password']);
			$confirm_password = htmlspecialchars($_POST['confirm_password']);

			if (strlen($username) >= 2 && strlen($username) <= 25)  
	    	{
	    		$_SESSION['save_username'] = $username;

		    	if (filter_var($email, FILTER_VALIDATE_EMAIL))
			    {
			    	$_SESSION['save_email'] = $email;

			    	$userManager = new \App\model\UserManager();
				    $checkExistUser = $userManager->existUser($username, $email);

				    if ($checkExistUser == 0) 
				    {
				    	if (preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $password)) 
				    	{
				    		if ($password === $confirm_password)
				    		{
				    			// Hashage du mot de passe
				    			$password = password_hash($password, PASSWORD_DEFAULT);

				    			// Génération d'une clé aléatoire de 16 caractères
				    			$length = 16;
				    			$token = bin2hex(random_bytes($length));

				    			// Ajout du nouvel utilisateur dans la base de données
				    			$new_user = new \App\model\User([
									'username' => $username,
									'email'    => $email,
									'password' => $password,
									'token'    => $token
				    			]);
								$userManager->addUser($new_user);

								// Envoi du mail et affichage de la page de confirmation
				    			$new_mail = new \App\model\Mail($email);
				    			$new_mail->send_register_mail($username, $token);

								$_SESSION['save_username'] = null;
								$_SESSION['save_email']    = null;
				    			header('Location: ./confirmation_inscription');
				    			exit;
				    		}
				    		else
				    		{
				    			$this->alert_failure('Les mots de passes renseignés doivent être identiques', 'inscription');
				    		}
				    	}
				    	else
				    	{
				    		$this->alert_failure('Le mot de passe doit contenir au moins 8 caractères avec des chiffres et des lettres majuscules et minuscules', 'inscription');
				    	}
				    }
				    else
				    {
						$_SESSION['save_username'] = null;
						$_SESSION['save_email']    = null;
				    	$this->alert_failure('Ce nom d\'utilisateur ou cette adresse email est déjà utilisé', 'inscription');
				    }
			    }
			    else
			    {
			    	$this->alert_failure('Cette adresse email n\'est pas valide', 'inscription');
			    }
			}
			else
			{
				$this->alert_failure('Le nom d\'utilisateur doit faire entre 2 et 25 caractères', 'inscription');
			}
		}
		else
		{
			$this->alert_failure('Les données transmissent ne sont pas valides', 'inscription');
		}
	}

	/**
	 * Permet la connexion d'un utilisateur avec son email ou son nom d'utilisateur. Si l'utilisateur n'a pas préalablement validé son adresse mail en cliquant sur le lien du mail envoyé, un mail lui est renvoyé en entrant ses identifiants. Si celui-ci coche la case "se souvenir de moi", un cookie est créer et des variables de session (id, username) sont initialisées dans tous les cas.
	 */
	public function processConnexion()
	{
		if (isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['password']) && !empty($_POST['password'])) 
		{
			$login    = htmlspecialchars($_POST['login']);
			$password = htmlspecialchars($_POST['password']);

			if (filter_var($login, FILTER_VALIDATE_EMAIL)) 
			{
				$newUser = new \App\model\User(['email' => $login]);
			}
			else
			{
				$newUser = new \App\model\User(['username' => $login]);
			}

			$userManager = new \App\model\UserManager();
			$connectData = $userManager->getUser($newUser);
		
			if ($login == $connectData->username() || $login == $connectData->email()) 
			{
				$_SESSION['save_login'] = $login;

				if (password_verify($password, $connectData->password())) 
				{
					if ($connectData->confirm_register() === 0) 
					{
						// Envoi du mail et alerte de confirmation
				    	$new_mail = new \App\model\Mail($connectData->email());
				    	$new_mail->send_register_mail($connectData->username(), $connectData->token());

						$this->alert_success('Un mail viens de vous être renvoyé pour que vous puissiez valider votre compte. Vérifiez vos spam !');
						header('Location: ./confirmation_inscription');
					}
					else
					{
						$_SESSION['user_id']       = $connectData->id();
						$_SESSION['user_username'] = $connectData->username();

						// Si l'utilisateur a coché la case "Se souvenir de moi"
						if (isset($_POST['remember'])) 
						{
							setcookie('auth', $connectData->id() . '---' . sha1($connectData->username() . $connectData->password() . $_SERVER['REMOTE_ADDR']), time() + 3600 * 24 * 365, null, null, false, true);
						}
						header('Location: ./dashboard');
						exit();
					}
				}
				else
				{
					$this->alert_failure('Mot de passe incorrect', 'connexion');
				}
			}
			else
			{
				$this->alert_failure('Cet utilisateur n\'existe pas', 'connexion');
			}
		}
		else
		{
			$this->alert_failure('Les données transmissent ne sont pas valides', 'connexion');
		}
	}

	/**
	 * Permet la génération d'un token et l'envoi d'un mail contenant celui-ci à l'adresse mail renseigné pour que l'utilisateur puisse modifier son mot de passe.
	 */
	public function processForgottenPassword()
	{
		if (isset($_POST['email']) && !empty($_POST['email']))  
		{
			$email = htmlspecialchars($_POST['email']);

			// Génération d'une clé aléatoire de 16 caractères
			$length = 16;
			$token  = bin2hex(random_bytes($length));

			$user        = new \App\model\User(['email' => $email]);
			$userManager = new \App\model\UserManager();
			$courentUser = $userManager->getUser($user);

			if ($email == $courentUser->email()) 
			{
				$courentUser->setToken($token);
				$userManager->editUser($courentUser);

				// Envoi du mail
				$new_mail = new \App\model\Mail($courentUser->email());
				$new_mail->send_forgot_pass_mail($courentUser->username(), $courentUser->token());

				$this->alert_success('Un mail viens de vous être envoyé pour que vous puissiez réinitiliser votre mot de passe. Vérifiez vos spam !');

				header('Location: ./mot_de_passe_oublie');
				exit();
			}
			else
			{
				$this->alert_failure('Cette adresse email n\'existe pas', 'mot_de_passe_oublie');
			}
		}
		else
		{
			$this->alert_failure('Les données transmissent ne sont pas valides', 'mot_de_passe_oublie');
		}
	}

	/**
	 * [proccesssNewPassword description]
	 */
	public function processNewPassword()
	{
		if (isset($_POST['password']) && !empty($_POST['password']) 
			&& isset($_POST['confirm_password']) && !empty($_POST['confirm_password'])
			&& isset($_GET['username']) && !empty($_GET['username'])
			&& isset($_GET['key']) && !empty($_GET['key'])) 
		{
			$password         = htmlspecialchars($_POST['password']);
			$confirm_password = htmlspecialchars($_POST['confirm_password']);
			$username         = htmlspecialchars($_GET['username']);
			$token            = htmlspecialchars($_GET['key']);

			if (preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $password)) 
			{
				if ($password === $confirm_password)
				{
	    			// Hashage du mot de passe
	    			$password = password_hash($password, PASSWORD_DEFAULT);

	    			$user        = new \App\model\User(['username' => $username]);
					$userManager = new \App\model\UserManager();
					$courentUser = $userManager->getUser($user);

					if ($courentUser->token() == $token) 
					{
						$userEdit = new \App\model\User([
							'username' => $courentUser->username(),
							'email' => $courentUser->email(),
							'password' => $password,
							'token' => null
						]);

						$userManager->editUser($userEdit);
						$this->alert_success('Votre nouveau mot de passe à bien été enregistré, vous pouvez vous connecter');
						header('Location: ./connexion');
						exit();
					}
					else
					{
				   		$this->alert_failure('Les données transmises ne correspondent pas aux données de l\'utilisateur', 'nouveau_mot_de_passe&username=' . $_GET['username'] . '&key=' . $_GET['key']);
					}
	    		}
	    		else
	    		{
				   $this->alert_failure('Les mots de passes renseignés doivent être identiques', 'nouveau_mot_de_passe&username=' . $_GET['username'] . '&key=' . $_GET['key']);
	    		}
	    	}
	    	else
	    	{
				$this->alert_failure('Le mot de passe doit contenir au moins 8 caractères avec des chiffres et des lettres majuscules et minuscules', 'nouveau_mot_de_passe&username=' . $_GET['username'] . '&key=' . $_GET['key']);
	    	}
		}
		else
		{
			$this->alert_failure('Les données transmissent ne sont pas valides', 'nouveau_mot_de_passe&username=' . $_GET['username'] . '&key=' . $_GET['key']);
		}
	}

}