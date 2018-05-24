<?php 
namespace App\controller;

/**
 * Class ControllerPrivate
 * Controller qui gère les views et les models de la partie privé du site (tableau de bord, paramètres utilisateurs, création d'un nouveau projet, list des projets ouverts existant et messagerie interne). 
 */
class ControllerPrivate extends Alert
{

	/**
	 * Vérification de l'existence d'un session de l'utilisateur pour autoriser l'accès à la partie privée.
	 */
	public function __construct()
	{
		if (empty($_SESSION['user_id']) && empty($_SESSION['user_username'])) 
		{ 
			header('Location: ./connexion');
			exit();
		}
	}

	/**
	 * Permet la récupération des projets en cours d'un utilisateur.
	 * @return array Tableau contenant les données des projets auquels l'utilisateur a accès.
	 */
	public function callUserProjects()
	{
		$user = new \App\model\User([
			'id'       => $_SESSION['user_id'], 
			'username' => $_SESSION['user_username']
		]);

		$projectManager = new \App\model\ProjectManager();
		$projects = $projectManager->getUserProjects($user);
		return $projects;
	}

	/**
	 * Permet la récupération des données concernant l'utilisateur actuellement connecté.
	 * @return array Tableau contenant les données de l'utilisateur connecté.
	 */
	public function callUserData()
	{
		$user = new \App\model\User([
			'id'       => $_SESSION['user_id'], 
			'username' => $_SESSION['user_username']
		]);

		$userManager = new \App\model\UserManager();
		$userData = $userManager->getUser($user);
		return $userData;
	}

	/**
	 *  Méthode d'affichage du tableau de bord (dashboard) et des projets en cours de l'utilisateur.
	 */
	public function displayDashboard()
	{
		$projects = $this->callUserProjects();
		$userData = $this->callUserData();
		require('./view/viewPrivate/viewDashboard.php');
	}

	/**
	 * Méthode d'affichage des paramètre de l'utilisateur.
	 */
	public function displayUserSettings()
	{
		$userData = $this->callUserData();
		$projects = $this->callUserProjects();
		require('./view/viewPrivate/viewUserSettings.php');
	}

	/**
	 * Méthode d'affichage de la messagerie interne (messages non lus)
	 */
	public function displayMessagingNotSeen()
	{
		$userData = $this->callUserData();
		$projects = $this->callUserProjects();
		require('./view/viewPrivate/viewMessagingNotSeen.php');
	}

	/**
	 * Méthode d'affichage de la messagerie interne (toutes les discussions)
	 */
	public function displayMessagingAll()
	{
		$userData = $this->callUserData();
		$projects = $this->callUserProjects();
		require('./view/viewPrivate/viewMessagingAll.php');
	}

	/**
	 * Méthode d'affichage de la messagerie interne (discussion privé entre deux utilisateurs)
	 */
	public function displayMessagingTalk()
	{
		$userData = $this->callUserData();
		$projects = $this->callUserProjects();
		require('./view/viewPrivate/viewMessagingTalk.php');
	}

	/**
	 * Permet de déconnecter un utilisateur.
	 */
	public function disconnect()
	{
		session_destroy();
		setcookie('auth', '', time() - 3600, null, null, false, true);
		header('Location: ./');
		exit();
	}

	// PROCESS ------
	
	/**
	 * Permet l'édition des données concernant l'utilisdateur par celui-ci (nom d'utilisateur, email, mot de passe).
	 */
	public function processEditUser()
	{
		$userData = $this->callUserData();

		if (!empty($_POST)
			&& isset($_POST['username']) && !empty($_POST['username'])
			&& isset($_POST['email']) && !empty($_POST['email']))
		{
			$username = htmlspecialchars($_POST['username']);
			$email    = htmlspecialchars($_POST['email']);

			// Si on modifie le mot de passe
			if (isset($_POST['password']) && !empty($_POST['password']) 
				&& isset($_POST['confirm_password']) && !empty($_POST['confirm_password'])) 
			{
				$initial_password = htmlspecialchars($_POST['password']);
				$confirm_password = htmlspecialchars($_POST['confirm_password']);

				if (strlen($initial_password) >= 8 && preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $initial_password)) 
	    		{
					if ($initial_password == $confirm_password)
					{
						$password = password_hash($initial_password, PASSWORD_DEFAULT);
					}
					else
					{
						$this->alert_failure('Les mots de passes renseignés doivent être identiques', 'parametres');
						exit();
					}
				}
				else
				{
					$this->alert_failure('Le mot de passe doit contenir au moins 8 caractères avec des chiffres et des lettres', 'parametres');
					exit();
				}
			// Si les inputs pour modifier le mot de passe reste vide
			}
			else
			{
				$password = $userData->password();
			}

			if (strlen($username) >= 2 && strlen($username) <= 25)  
			{
				if (filter_var($email, FILTER_VALIDATE_EMAIL))
	   			{
	   				$userManager = new \App\model\UserManager();
	   				$countUserData = $userManager->existUser($username, $email);

	   				if ($countUserData <= 1) 
	   				{
	   					$editUser = new \App\model\User([
							'id'       => $_SESSION['user_id'],
							'username' => $username,
							'email'    => $email,
							'password' => $password
						]);
						
						$userManager->editUser($editUser);

						$_SESSION['user_username'] = $username;

						$this->alert_success('Vos informations ont bien été mises à jour !');
						header('Location: ./parametres');
						exit();
	   				}
	   				else
	   				{
	   					$this->alert_failure('Ce nom d\'utilisateur ou cetter adresse email existe déjà', 'parametres');
	   				}
	   			}
	   			else
	   			{
	   				$this->alert_failure('Cette adresse email n\'est pas valide', 'parametres');
	   			}
			}
			else
			{
				$this->alert_failure('Le nom d\'utilisateur doit faire entre 2 et 25 caractères', 'parametres');
			}
		}
		else
		{
			$this->alert_failure('Les champs "Nom d\'utilisateur" et "Email" doivent être correctement remplis', 'parametres');
		}
	}
}