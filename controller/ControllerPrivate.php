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
	 * Instancie l'objet User avec les données de l'utilisateur en cours.
	 * @return Object User
	 */
	private function initUser()
	{
		$user = new \App\model\User([
			'id'       => $_SESSION['user_id'], 
			'username' => $_SESSION['user_username']
		]);

		return $user;
	}

	/**
	 * Permet la récupération des projets en cours d'un utilisateur.
	 * @return array Tableau contenant les données des projets auquels l'utilisateur a accès.
	 */
	private function callUserProjects()
	{
		$user = $this->initUser();
		$projectManager = new \App\model\ProjectManager();
		$projects       = $projectManager->getUserProjects($user);
		return $projects;
	}

	/**
	 * Permet la récupération des données concernant l'utilisateur actuellement connecté.
	 * @return array Tableau contenant les données de l'utilisateur connecté.
	 */
	private function callUserData()
	{
		$user = $this->initUser();
		$userManager = new \App\model\UserManager();
		$userData    = $userManager->getUser($user);
		return $userData;
	}

	/**
	 * Permet de récupérer le nombre de message non-lus de l'utilisateur en cours.
	 * @return int Nombre de message non-lus.
	 */
	private function callNotSeenMessage()
	{
		$user = $this->initUser();
		$messageManager = new \App\model\MessageManager();
		$notSeenMessage = $messageManager->getNotSeenMessage($user);
		return $notSeenMessage;
	}

	/**
	 *  Méthode d'affichage du tableau de bord (dashboard) et des projets en cours de l'utilisateur.
	 */
	public function displayDashboard()
	{
		$projects       = $this->callUserProjects();
		$userData       = $this->callUserData();
		$notSeenMessage = $this->callNotSeenMessage();
		require('./view/viewPrivate/viewDashboard.php');
	}

	/**
	 * Méthode d'affichage de la page de création de projet.
	 */
	public function displayCreateProject()
	{
		$projects       = $this->callUserProjects();
		$userData       = $this->callUserData();
		$notSeenMessage = $this->callNotSeenMessage();
		require('./view/viewPrivate/viewCreateProject.php');
	}

	/**
	 * Méthode d'affichage des paramètre de l'utilisateur.
	 */
	public function displayUserSettings()
	{
		$userData       = $this->callUserData();
		$projects       = $this->callUserProjects();
		$notSeenMessage = $this->callNotSeenMessage();
		require('./view/viewPrivate/viewUserSettings.php');
	}

	/**
	 * Méthode d'affichage de la messagerie interne (toutes les discussions)
	 */
	public function displayMessaging()
	{
		$userData       = $this->callUserData();
		$projects       = $this->callUserProjects();
		$notSeenMessage = $this->callNotSeenMessage();

		$messageManager = new \App\model\MessageManager();
		$conversations  = $messageManager->getConversations($userData);
		$contacts       = $messageManager->getMainContact($userData);

		require('./view/viewPrivate/viewMessaging.php');
	}

	/**
	 * Méthode d'affichage de la page contenant la liste de tous les projets ouverts.
	 */
	public function displayOpenProjects()
	{
		$projects       = $this->callUserProjects();
		$userData       = $this->callUserData();
		$notSeenMessage = $this->callNotSeenMessage();
		$projectManager = new \App\model\ProjectManager();

		if (isset($_GET['search']) && !empty($_GET['search'])) 
		{
			$search       = htmlspecialchars($_GET['search']);
			$openProjects = $projectManager->searchOpenProject($userData, $search);
		}
		else
		{
			$openProjects = $projectManager->getOpenProjects($userData);
		}

		require('./view/viewPrivate/viewOpenProjects.php');
	}

	/**
	 * /messagerie/talk
	 * Méthode d'affichage de la messagerie interne (discussion privé entre deux ou plusieurs utilisateurs)
	 */
	public function displayMessagingTalk()
	{
		$userData       = $this->callUserData();
		$projects       = $this->callUserProjects();

		if (isset($_GET['conv']) && !empty($_GET['conv'])) 
		{
			$id_conversation = (int) htmlspecialchars($_GET['conv']);

			$messageManager  = new \App\model\MessageManager();
			$accessConv      = $messageManager->getAccessUserConversation($userData, $id_conversation);

			if ($accessConv == 1) 
			{
				$messageManager->seenConversation($userData, $id_conversation);
				$notSeenMessage = $this->callNotSeenMessage();

				$users_conversation = $messageManager->getUsersConversations($id_conversation, $_SESSION['user_id']);
				$main_contact_add = $messageManager->getMainContactAdd($userData, $id_conversation);
				$conversation       = $messageManager->getConversation($id_conversation);
				require('./view/viewPrivate/viewMessagingTalk.php');
			}
			else
			{
				$this->alert_failure('Vous n\'êtes pas autorisé à accéder à cette conversation', '../messagerie');
			}
		}
		else 
		{
			$this->alert_failure('Cette conversation n\'existe pas', '../messagerie');
		}
	}

	/**
	 * /disconnect
	 * Permet de déconnecter un utilisateur.
	 */
	public function disconnect()
	{
		session_destroy();
		setcookie('auth', '', time() - 3600, null, null, false, true);
		header('Location: ./');
		exit();
	}

	/**
	 * /parametres
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

	/**
	 * /messagerie
	 * Permet de créer une nouvelle conversation (vérification des données reçues, vérification de l'utilisateur).
	 * Si une données utilisateur est transmise, sa vérification est effectuée.
	 * S'il n'y a pas de données utilisateur, la conversation est créer sans y ajouter d'utilisateur.
	 */
	public function newConversation()
	{
		$userData = $this->callUserData();

		$messageManager      = new \App\model\MessageManager();
		$id_new_conversation = $messageManager->addNewConversation($userData);

		if (isset($_GET['user']))
		{
			if ((int) !empty($_GET['user'])) 
			{
				$id_user     = (int) htmlspecialchars($_GET['user']);
				
				$userManager = new \App\Model\UserManager();
				$id_exist    = $userManager->existIdUser($id_user);

				if ($id_exist > 0) 
				{
					$messageManager->addUserConversation($id_new_conversation->id, $id_user);
					header('Location: ./messagerie/talk?conv=' . $id_new_conversation->id);
					exit();
				}
				else
				{
					$this->alert_failure('L\'identifiant de l\'utilisateur que vous souhaitez ajouter n\'existe pas', 'messagerie');
				}
			}
			else
			{
				$this->alert_failure('L\'identifiant de l\'utilisateur que vous souhaitez ajouter n\'est pas correct', 'messagerie');
			}
		}
		else
		{
			header('Location: ./messagerie/talk?conv=' . $id_new_conversation->id);
		}
	}

	/**
	 * /messagerie/talk
	 * Permet d'ajouter un utilisateur (avec son pseudo (barre de recherche) ou son id) à une conversation déjà existante.
	 */
	public function addUserConversation()
	{
		if (isset($_GET['conv']) && !empty($_GET['conv']) 
			&& isset($_GET['user']) && !empty($_GET['user']))
		{
			$userData = $this->callUserData();

			$id_conversation = (int) htmlspecialchars($_GET['conv']);

			$userManager    = new \App\Model\UserManager();
			$messageManager = new \App\model\MessageManager();

			$accessConv = $messageManager->getAccessUserConversation($userData, $id_conversation);

			if ($accessConv == 1) 
			{
				if (is_numeric($_GET['user']))
				{
					$id_user  = (int) htmlspecialchars($_GET['user']);
					$id_exist = $userManager->existIdUser($id_user);

					if ($id_exist > 0) 
					{
						$messageManager->addUserConversation($id_conversation, $id_user);
						$this->alert_success('L\'utilisateur a été ajouté à la conversation avec succès');
						header('Location: ./messagerie/talk?conv=' . $id_conversation);
						exit();
					}
					else
					{
						$this->alert_failure('L\'identifiant de l\'utilisateur que vous souhaitez ajouter n\'existe pas', 'messagerie/talk?conv=' . $id_conversation);
					}
				}
				elseif (is_string($_GET['user']))
				{
					$username       = htmlspecialchars($_GET['user']);
					$username_exist = $userManager->existUser($username, '');

					if ($username_exist > 0) 
					{
						$messageManager = new \App\model\MessageManager();

						$user = new \App\model\User(['username' => $username]);
						$id_user = $userManager->getUser($user);

						$messageManager->addUserConversation($id_conversation, $id_user->id());
						$this->alert_success('L\'utilisateur a été ajouté à la conversation avec succès');
						header('Location: ./messagerie/talk?conv=' . $id_conversation);
						exit();
					}
					else
					{
						$this->alert_failure('Le nom de l\'utilisateur que vous souhaitez ajouter n\'existe pas', 'messagerie/talk?conv=' . $id_conversation);
					}
				}
				else
				{
					$this->alert_failure('L\'identifiant de l\'utilisateur que vous souhaitez ajouter n\'est pas correct', 'messagerie/talk?conv=' . $id_conversation);
				}
			}
			else
			{
				$this->alert_failure('Vous n\'êtes pas autorisé à ajouté un utilisateur à cette conversation', 'messagerie/talk?conv=' . $id_conversation);
			}
		}
		else
		{
			$this->alert_failure('L\'identifiant de l\'utilisateur que vous souhaitez ajouter n\'est pas correct', 'messagerie');
		}
	}

	/**
	 * /messagerie/talk
	 * Permet d'ajouter un nouveau message à une conversation.
	 */
	public function processNewMessage()
	{
		if (isset($_POST['content']) && !empty($_POST['content']) 
			&& isset($_POST['conv']) && !empty($_POST['conv']))
		{
			$content         = htmlspecialchars($_POST['content']);
			$id_conversation = (int) htmlspecialchars($_POST['conv']);

			$userData       = $this->callUserData();
			$messageManager = new \App\model\MessageManager();
			$accessConv     = $messageManager->getAccessUserConversation($userData, $id_conversation);

			if ($accessConv == 1) 
			{
				$messageManager->addMessage($id_conversation, $_SESSION['user_id'], $content);
				header('Location: messagerie/talk?conv=' . $id_conversation);
				exit();
			}
			else
			{
				$this->alert_failure('Vous n\'êtes pas autorisé à poster un message dans cette conversation', 'messagerie');
			}
		}
		else
		{
			$this->alert_failure('Le contenu de votre message n\'est pas valide', 'messagerie');
		}
	}

	/**
	 * /messagerie
	 * Permet de retirer l'utilisateur en cours de la conversation qu'il a sélectionnée.
	 */
	public function processDeleteUserConversation()
	{
		if (isset($_GET['conv']) && !empty($_GET['conv'])) 
		{
			$id_conversation = (int) htmlspecialchars($_GET['conv']);

			$userData       = $this->callUserData();
			$messageManager = new \App\model\MessageManager();
			$accessConv     = $messageManager->getAccessUserConversation($userData, $id_conversation);

			if ($accessConv == 1) 
			{
				$messageManager->deleteUserConversation($id_conversation, $userData);
				$this->alert_success('Vous avez été retiré de cette conversation avec succès');
				header('Location: ./messagerie');
				exit();
			}
			else
			{
				$this->alert_failure('Cette conversation ne peut pas être supprimée car vous n\'y avez pas accès', 'messagerie');
			}
		}
		else
		{
			$this->alert_failure('L\'identifiant de la conversation à supprimer n\'est pas correct', 'messagerie');
		}
	}

	public function processNewProject()
	{
		if (isset($_POST['projectName']) && !empty($_POST['projectName'])
			&& isset($_POST['colorProject']) && !empty($_POST['colorProject'])  
			&& isset($_POST['statusProject'])
			&& isset($_POST['descriptionProject'])) 
		{
			$projectName   = htmlspecialchars($_POST['projectName']);
			$statusProject = (int) htmlspecialchars($_POST['statusProject']);
			$colorProject  = htmlspecialchars($_POST['colorProject']);
			$link          = strtolower(str_replace(' ', '-', $projectName));

			if (!empty($_POST['descriptionProject'])) 
			{
				$descriptionProject = htmlspecialchars($_POST['descriptionProject']);

				if (strlen($descriptionProject) > 180) 
				{
					$this->alert_failure('La description de votre projet est trop longue (180 caractères maximum)', 'nouveauProjet');
					exit();
				}
			}
			else
			{
				$descriptionProject = null;
			}

			if (strlen($projectName) <= 35) 
			{
				$projectManager = new \App\model\ProjectManager();
				$verifExistProjectName = $projectManager->existProject($projectName);

				if ($verifExistProjectName == 0) 
				{
					if (preg_match('/#([a-f0-9]{3}){1,2}\b/i', $colorProject))
					{
						if ($statusProject === 1) 
						{
							$open = (int) htmlspecialchars($_POST['openProject']);

							if ($open === 1 || $open === 0)
							{
								$newProject = new \App\model\Project([
									'name'        => $projectName,
									'link'		  => $link,
									'status'      => $statusProject,
									'open'		  => $open,
									'color'       => $colorProject,
									'description' => $descriptionProject
								]);
								goto executionNewProject;
							}
							else
							{
								$this->alert_failure('Le status de votre projet n\'est pas valide', 'nouveauProjet');
							}
						}
						elseif ($statusProject === 0) 
						{
							$newProject = new \App\model\Project([
								'name'        => $projectName,
								'link'		  => $link,
								'status'      => $statusProject,
								'open' 		  => null,
								'color'       => $colorProject,
								'description' => $descriptionProject
							]);

							executionNewProject:

							$projectManager->addProject($newProject);
							$actualProject = $projectManager->getProject($newProject);
							$projectManager->addUserInProject($_SESSION['user_id'], $actualProject->id(), 1);

							$this->alert_success('Votre projet <strong>' . $projectName . '</strong> a été créé avec succès !');
							header('Location: ./dashboard');
							exit();
						}
						else
						{
							$this->alert_failure('Le status de votre projet n\'est pas valide', 'nouveauProjet');
						}
					}
					else
					{
						$this->alert_failure('La couleur de votre projet n\'est pas valide', 'nouveauProjet');
					}
				}
				else
				{
					$this->alert_failure('Ce nom de projet existe déjà', 'nouveauProjet');
				}
			}
			else
			{
				$this->alert_failure('Le nom de votre projet est trop long (70 caractères maximum)', 'nouveauProjet');
			}
		}
		else
		{
			$this->alert_failure('Les informations transmises ne sont pas correctes', 'nouveauProjet');
		}
	}

	public function processAddUserOpenProject()
	{
		$userData = $this->callUserData();

		if (isset($_POST['id_open_project']) && !empty($_POST['id_open_project']) && isset($_POST['addOpenProject']) && $_POST['addOpenProject'] == 'addOpenProject')
		{
			$id_project = (int) htmlspecialchars($_POST['id_open_project']);

			$openProject    = new \App\model\Project(['id' => $id_project]);
			$projectManager = new \App\model\ProjectManager();
			$project        = $projectManager->getProject($openProject);

			if ($project->status() == 1) 
			{
				if ($project->open() == 0) 
				{
					$access = 3;
					$accessName = 'observateur';
				}
				else 
				{
					$access = 2;
					$accessName = 'contributeur';
				}
				$projectManager->addUserInProject($userData->id(), $project->id(), $access);

				$this->alert_success('Vous venez de rejoindre avec succès <strong>' . $project->name() . '</strong> comme <em>' . $accessName . '</em> !');
				header('Location: ./dashboard');
				exit();
			}
			else
			{
				$this->alert_failure('Vous n\'êtes pas autorisé à rejoindre ce projet', 'projetsOuverts');
			}
		}
		else
		{
			$this->alert_failure('Les informations transmises ne sont pas correctes', 'projetsOuverts');
		}
	}
}