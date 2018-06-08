<?php 
namespace App\controller;

/**
 * Controller qui gère les views et les models de la partie projet du site (accueil projet, todolist, wiki et les paramètres du projet).
 */
class ControllerProject extends Alert
{
	
	/**
	 * Permet de vérifier si l'utilisateur est bien connecté pour accéder à la partie projet et s'il possède l'autorisation de voir le projet qu'il consulte.
	 */
	public function __construct()
	{
		// Vérification de la connexion de l'utilisateur
		if (empty($_SESSION['user_id']) && empty($_SESSION['user_username'])) 
		{ 
			header('Location: ../../connexion');
			exit;
		}
		// Vérification du droit d'accéder au projet
		if($this->verifProject() === 0)
		{
			$this->alert_failure('Vous n\'êtes pas autorisé à accéder à ce projet', '../dashboard');
		}
	}

	/**
	 * Instancie l'objet User avec les données de l'utilisateur en cours.
	 * @return Object User Retourne l'objet contenant les toutes les données de l'utilisateur en cours. 
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
	 * Permet de vérifier si l'utilisateur qui essaye d'accèder au projet à les droits pour y accèder.
	 * @return int Renvoi 0 si l'utilisateur ne peux pas accèder à ce projet. 1 si celui-ci a les droits.
	 */
	private function verifProject()
	{
		$user = $this->initUser();
		$projectLink = explode("/", $_GET['url']);
		$projectManager = new \App\model\ProjectManager();
		return $projectManager->verifAccessProject($user->id(), $projectLink[1]);
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
	 * Permet de récupérer les données du projet en cours.
	 * @return object Récupération d'un objet Projet contenant les données du projet en cours de consultation.
	 */
	private function callProjectData()
	{
		$projectLink    = explode("/", $_GET['url']);
		
		$project        = new \App\model\Project(['link' => $projectLink[1]]);
		$projectManager = new \App\model\ProjectManager();
		$projectData    = $projectManager->getProject($project);
		return $projectData;
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
	 * Permet de récupérer les droits d'accès sur le projet en cours de consultation.
	 * @return objet Renvoi un objet (fetch) contenant les droits du projet en cours.
	 */
	public function callAccessToProject()
	{
		$project  = $this->callProjectData();
		$userData = $this->callUserData();
		$projectManager = new \App\model\ProjectManager();
		return $projectManager->getUserAccessProject($userData, $project);
	}


	/**
	 * Méthode d'affichage de l'accueil des projets.
	 * @param  string $slug Link du projet.
	 */
	public function displayHomeProject($slug)
	{
		$access 		= $this->callAccessToProject();
		$projects       = $this->callUserProjects();
		$notSeenMessage = $this->callNotSeenMessage();

		$project 		= $this->callProjectData();
		$userData       = $this->callUserData();
		require('./view/viewProject/viewHomeProject.php');
	}

	/**
	 * Permet l'affichage de la page de gestion des todolists.
	 * @param  string $slug Contient le lien du projet en cours de consultation.
	 */
	public function displayTodolist($slug)
	{
		$access 		= $this->callAccessToProject();
		$projects       = $this->callUserProjects();
		$notSeenMessage = $this->callNotSeenMessage();

		$project 		= $this->callProjectData();
		$userData       = $this->callUserData();

		$todolistManager = new \App\model\TodolistManager();
		$todolists       = $todolistManager->getTodolists($project);
		$tasks           = $todolistManager->getTasks($project);

		require('./view/viewProject/viewTodolist.php');
	}

	/**
	 * Permet l'affichage du wiki du projet.
	 * @param  string $slug Contient le lien du projet en cours de consultation.
	 */
	public function displayWiki($slug)
	{
		$access 		= $this->callAccessToProject();
		$projects       = $this->callUserProjects();
		$notSeenMessage = $this->callNotSeenMessage();

		$project 		= $this->callProjectData();
		$userData       = $this->callUserData();
		require('./view/viewProject/viewWiki.php');
	}

	/**
	 * Permet l'affichage de la page de gestion des utilisateurs du projet.
	 * @param  string $slug Contient le lien du projet en cours de consultation.
	 */
	public function displayProjectUsers($slug)
	{
		$access 		= $this->callAccessToProject();
		$projects       = $this->callUserProjects();
		$notSeenMessage = $this->callNotSeenMessage();

		$project 		= $this->callProjectData();
		$userData       = $this->callUserData();

		$projectManager = new \App\model\ProjectManager();
		$users = $projectManager->getAllUsersProject($project);
		
		require('./view/viewProject/viewProjectUsers.php');
	}

	/**
	 * Permet l'affichage de la page des paramètres du projet (accessible uniquement au fondateur du projet).
	 * @param  string $slug Contient le lien du projet en cours de consultation.
	 */
	public function displayProjectSettings($slug)
	{
		$access 		= $this->callAccessToProject();
		$projects       = $this->callUserProjects();
		$notSeenMessage = $this->callNotSeenMessage();

		$project 		= $this->callProjectData();
		$userData       = $this->callUserData();
		require('./view/viewProject/viewProjectSettings.php');
	}

	// ------- PROCESS -------
	
	/**
	 * Permet de supprimer le projet sélectionné (page paramètres projet).
	 */
	public function processDeleteProject()
	{
		$project = $this->callProjectData();

		if (isset($_POST['deleteProject']) && $_POST['deleteProject'] == 'deleteProject') 
		{
			$projectManager = new \App\model\ProjectManager();
			$projectManager->deleteProject($project);
			$this->alert_success('Le projet "<strong>' . $project->name() . '</strong>" a bien été supprimé');
			header('Location: ' . \App\model\App::getDomainPath() . '/dashboard');
			exit;
		}
		else
		{
			$this->alert_failure('Les données transmises sont incorrectes', '/projet/' . $project->link() . '/parametres');
		}
	}

	/**
	 * Permet d'éditer les paramètres du projet (page paramètres projet).
	 */
	public function processEditProject()
	{
		$project = $this->callProjectData();

		if (isset($_POST['nameProject']) && !empty($_POST['nameProject'])
			&& isset($_POST['colorProject']) && !empty($_POST['colorProject'])  
			&& isset($_POST['statusProject'])
			&& isset($_POST['descriptionProject'])) 
		{
			$projectName   = htmlspecialchars($_POST['nameProject']);
			$statusProject = (int) htmlspecialchars($_POST['statusProject']);
			$colorProject  = htmlspecialchars($_POST['colorProject']);
			$link          = strtolower(str_replace(' ', '-', $projectName));

			if (!empty($_POST['descriptionProject'])) 
			{
				$descriptionProject = htmlspecialchars($_POST['descriptionProject']);

				if (strlen($descriptionProject) > 180) 
				{
					$this->alert_failure('La description de votre projet est trop longue (180 caractères maximum)', 'nouveauProjet');
					exit;
				}
			}
			else
			{
				$descriptionProject = null;
			}

			if (strlen($projectName) <= 70) 
			{
				$projectManager = new \App\model\ProjectManager();
				$verifExistProjectName = $projectManager->existOtherProject($projectName, $project->id());

				if ($verifExistProjectName == 0) 
				{
					if (preg_match('/#([a-f0-9]{3}){1,2}\b/i', $colorProject))
					{
						if ($statusProject === 1)
						{
							$open = (int) htmlspecialchars($_POST['openProject']);

							if ($open === 1 || $open === 0)
							{
								$modifiedProject = new \App\model\Project([
									'name'        => $projectName,
									'link'		  => $link,
									'status'      => $statusProject,
									'open'		  => $open,
									'color'       => $colorProject,
									'description' => $descriptionProject
								]);
								goto executionModifiedProject;
							}
							else
							{
								$this->alert_failure('Le status de votre projet n\'est pas valide', 'parametres');
							}
						}
						elseif ($statusProject === 0)
						{
							$modifiedProject = new \App\model\Project([
								'name'        => $projectName,
								'link'		  => $link,
								'status'      => $statusProject,
								'open' 		  => null,
								'color'       => $colorProject,
								'description' => $descriptionProject
							]);

							executionModifiedProject:

							$projectManager->editProject($project->id(), $modifiedProject);
							$actualProject = $projectManager->getProject($modifiedProject);

							$this->alert_success('Votre projet "<strong>' . $projectName . '</strong>" a été modifié avec succès !');
							header('Location: ' . \App\model\App::getDomainPath() . '/projet/' . $actualProject->link() .'/parametres');
							exit;
						}
						else
						{
							$this->alert_failure('Le status de votre projet n\'est pas valide', 'parametres');
						}
					}
					else
					{
						$this->alert_failure('La couleur de votre projet n\'est pas valide', 'parametres');
					}
				}
				else
				{
					$this->alert_failure('Ce nom de projet existe déjà', 'parametres');
				}
			}
			else
			{
				$this->alert_failure('Le nom de votre projet est trop long (70 caractères maximum)', 'parametres');
			}
		}
		else
		{
			$this->alert_failure('Les données transmises sont incorrectes', 'parametres');
		}
	}

	/**
	 * Permet d'éditer le wiki d'un projet (page wiki).
	 */
	public function processEditWiki()
	{
		$project = $this->callProjectData();

		if (isset($_POST['wikiProject']) && isset($_POST['editWiki']) && $_POST['editWiki'] == 'editWiki') 
		{
			// Pas de vérification contre les failles XSS (tinymce fait cette vérification par défaut)
			$wiki = $_POST['wikiProject'];
			$projectManager = new \App\model\ProjectManager();
			$projectManager->editWiki($project, $wiki);

			$this->alert_success('Le wiki a été édité avec succès !');
			header('Location: ' . \App\model\App::getDomainPath() . '/projet/' . $project->link() .'/wiki');
			exit;
		}
		else
		{
			$this->alert_failure('Les données transmises sont incorrectes', 'wiki');
		}
	}

	/**
	 * Permet à un utilisateur de quitter un projet où il est observateur ou contributeur (projets observateurs ou contributeurs).
	 */
	public function processUserWithdrawProject()
	{
		$userData = $this->callUserData();
		$project  = $this->callProjectData();

		if (isset($_POST['withdrawProject']) && $_POST['withdrawProject'] == 'withdrawProject')
		{
			$projectManager = new \App\model\ProjectManager();
			$projectManager->withdrawProject($project, $userData->id());
			$this->alert_success('Vous avez quitté le projet <strong>"' . $project->name() . '"</strong> avec succès');
			header('Location: ../../dashboard');
			exit;
		}
		else
		{
			$this->alert_failure('Les données transmises sont incorrectes', 'home');
		}
	}

	/**
	 * Permet à un administrateur de retirer un utilisateur du projet en cours.
	 */
	public function processRemoveUserProject()
	{
		$project = $this->callProjectData();

		if (isset($_POST['removeUser']) && $_POST['removeUser'] == 'removeUser'
			&& isset($_POST['id_user']) && !empty($_POST['id_user']))
		{
			$id_user = (int) htmlspecialchars($_POST['id_user']);

			$projectManager = new \App\model\ProjectManager();
			$projectManager->withdrawProject($project, $id_user);
			$this->alert_success('L\'utilisateur a été retiré du projet avec succès');
			header('Location: ./utilisateurs');
			exit;
		}
		else
		{
			$this->alert_failure('Les données transmises sont incorrectes', 'utilisateurs');
		}
	}

	/**
	 * Permet à l'administrateur d'un projet de changer le status d'un des utilisateur affilié au projet.
	 */
	public function processChangeUserStatus()
	{
		$project = $this->callProjectData();

		if (isset($_POST['changeUserStatus']) && $_POST['changeUserStatus'] == 'changeUserStatus'
			&& isset($_POST['changeStatus']) && !empty($_POST['changeStatus'])
			&& isset($_POST['id_user']) && !empty($_POST['id_user']))
		{
			$access  = (int) htmlspecialchars($_POST['changeStatus']);
			$id_user = (int) htmlspecialchars($_POST['id_user']);

			if ($access == 2 || $access == 3) 
			{
				$projectManager = new \App\model\ProjectManager();
				$projectManager->editUserAccess($project, $id_user, $access);
				$this->alert_success('Le status de l\'utilisateur a été modifié avec succès');
				header('Location: ./utilisateurs');
				exit;
			}
			else
			{
				$this->alert_failure('Les valeurs transmises sont incorrectes', 'utilisateurs');
			}
		}
		else
		{
			$this->alert_failure('Les données transmises sont incorrectes', 'utilisateurs');
		}
	}

	/**
	 * Permet d'ajouter un utilisateur au projet (s'il a un compte sur la plateforme) ou d'inviter une personne (via son adresse mail renseigné) à créer un compte sur la plateforme (s'il n'a pas de compte).
	 */
	public function processAddUserInProject()
	{
		$project  = $this->callProjectData();
		$userData = $this->callUserData();

		if (isset($_POST['newUserProject']) && !empty($_POST['newUserProject'])
			&& isset($_POST['statusNewUserProject']) && !empty($_POST['statusNewUserProject']))
		{
			$user   = htmlspecialchars($_POST['newUserProject']);
			$access = (int) htmlspecialchars($_POST['statusNewUserProject']);

			if ($access == 2 || $access == 3) 
			{
				$userManager = new \App\model\UserManager();
				$verifExistUser = $userManager->existUser($user, $user);

				if ($verifExistUser == 1) 
				{
					if (filter_var($user, FILTER_VALIDATE_EMAIL))
					{
						$userSearch = new \App\model\User(['email' => $user]);
					}
					else
					{
						$userSearch = new \App\model\User(['username' => $user]);
					}
					$userObject = $userManager->getUser($userSearch);
					$projectManager = new \App\model\ProjectManager();
					$alreadyInProject = $projectManager->verifUserProject($userObject, $project);

					if ($alreadyInProject == 0) 
					{
						$projectManager->addUserInProject($userObject->id(), $project->id(), $access);
						$this->alert_success('<strong>' . $userObject->username() . '</strong> a été affilié au projet avec succès !');
						header('Location: ./utilisateurs');
						exit;
					}
					else
					{
						$this->alert_failure('<strong>' . $userObject->username() . '</strong> est déjà affilié à ce projet', 'utilisateurs');
					}
				}
				else
				{
					if (filter_var($user, FILTER_VALIDATE_EMAIL)) 
					{
						$new_mail = new \App\model\Mail($user);
						$new_mail->send_user_project_mail($userData->username(), $project->name(), $access);
						$this->alert_success('Un mail a été envoyé à ' . $user . ' pour rejoindre la plateforme. <br>Ajoutez-le de nouveau au projet après son inscription pour l\'ajouter au projet.');
						header('Location: ./utilisateurs');
						exit;
					}
					else
					{
						$this->alert_failure('Ce nom d\'utilisateur n\'existe pas', 'utilisateurs');
					}
				}
			}
			else
			{
				$this->alert_failure('Les valeurs transmises sont incorrectes', 'utilisateurs');
			}
		}
		else
		{
			$this->alert_failure('Les données transmises sont incorrectes', 'utilisateurs');
		}
	}

	/**
	 * Permet de créer une nouvelle todolist (page todolist).
	 */
	public function processAddTodolist()
	{
		$project = $this->callProjectData();

		if (isset($_POST['nameTodolist']) && !empty($_POST['nameTodolist']) 
			&& isset($_POST['newTodolist']) && $_POST['newTodolist'] == 'newTodolist') 
		{
			$name = htmlspecialchars($_POST['nameTodolist']);

			$todolistManager    = new \App\model\TodolistManager();
			$verifExistTodolist = $todolistManager->verifTodolistExist($project, $name);

			if ($verifExistTodolist == 0) 
			{
				$todolistManager->addTodolist($project, $name);
				header('Location: ./todolist');
				exit;
			}
			else
			{
				$this->alert_failure('Cette todolist existe déjà sur ce projet', 'todolist');
			}
		}
		else
		{
			$this->alert_failure('Les données transmises sont incorrectes', 'todolist');
		}
	}

	/**
	 * Permet d'enregistrer l'ordre des tâches réorganisées par l'utilisateur avec le drag & drop (page todolist).
	 */
	public function processOrder()
	{
		$project = $this->callProjectData();

		if (isset($_POST['todolist_id']) && !empty($_POST['todolist_id']) 
			&& isset($_POST['serializedOrder']) && !empty($_POST['serializedOrder'])) 
		{
			$todolist_id     = (int) htmlspecialchars($_POST['todolist_id']);
			$serializedData  = htmlspecialchars($_POST['serializedOrder']);
			$todolistManager = new \App\model\TodolistManager();
			$verifTodolist   = $todolistManager->verifTodolistInProject($project, $todolist_id);

			if ($verifTodolist == 1) 
			{
				$serial = explode(';', $serializedData);
				$todolistManager->updateTaskOrder($todolist_id, serialize($serial));
				header('Location: ./todolist');
				exit;
			}
			else
			{
				$this->alert_failure('Vous ne pouvez pas modifier cette todolist', 'todolist');
			}
		}
		else
		{
			$this->alert_failure('Les données transmises sont incorrectes', 'todolist');
		}
	}

	/**
	 * Permet d'enregisitrer qu'une tâche à été indiquée comme étant terminée ou non (checkbox cochée ou non)(page todolist).
	 */
	public function processDoneTask()
	{
		$project = $this->callProjectData();

		if (isset($_POST['done_task_id']) && !empty($_POST['done_task_id']) 
			&& isset($_POST['isDoneTask']))
		{
			$done_task_id = (int) htmlspecialchars($_POST['done_task_id']);
			$done         = (int) htmlspecialchars($_POST['isDoneTask']);

			$todolistManager = new \App\model\TodolistManager();
		
			$todolistManager->updateDoneTask($done, $done_task_id);
			header('Location: ./todolist');
			exit;
		}
		else
		{
			$this->alert_failure('Les données transmises sont incorrectes', 'todolist');
		}
	}

	/**
	 * Permet d'effacer une todolist (page todolist).
	 */
	public function processDeleteTodolist()
	{
		$project = $this->callProjectData();

		if (isset($_POST['todolist_id']) && !empty($_POST['todolist_id']) 
			&& isset($_POST['deleteTodolist']) && $_POST['deleteTodolist'] == 'deleteTodolist')
		{
			$todolist_id = (int) htmlspecialchars($_POST['todolist_id']);
			$todolistManager = new \App\model\TodolistManager();
			
			$verifTodolist = $todolistManager->verifTodolistInProject($project, $todolist_id);

			if ($verifTodolist == 1) 
			{
				$todolistManager->deleteTodolist($todolist_id);
				$this->alert_success('La todolist a été supprimée avec succès !');
				header('Location: ./todolist');
				exit;
			}
			else
			{
				$this->alert_failure('Vous ne pouvez pas modifier cette todolist', 'todolist');
			}
		}
		else
		{
			$this->alert_failure('Les données transmises sont incorrectes', 'todolist');
		}
	}

	/**
	 * Permet d'ajouter une tâche à une todolist (page todolist).
	 */
	public function processAddTask()
	{
		$project = $this->callProjectData();

		if (isset($_POST['todolist_id']) && !empty($_POST['todolist_id'])
			&& isset($_POST['nameTask']) && !empty($_POST['nameTask'])
			&& isset($_POST['addTask']) && $_POST['addTask'] == 'addTask')
		{
			$task_name   = htmlspecialchars($_POST['nameTask']);
			$todolist_id = (int) htmlspecialchars($_POST['todolist_id']);

			$todolistManager = new \App\model\TodolistManager();
			$verifTodolist   = $todolistManager->verifTodolistInProject($project, $todolist_id);

			if ($verifTodolist == 1) 
			{
				$lastId   = $todolistManager->addTask($todolist_id, $task_name);
				$todolist = $todolistManager->getTodolist($todolist_id);
				$oldOrder = unserialize($todolist->task_order);
				if (is_array($oldOrder)) 
				{
					// array_unshift($oldOrder, $lastId->id);
					$oldOrder[] = $lastId->id;
					$newOrder   = serialize($oldOrder);
				}
				else
				{
					$order    = [$lastId->id];
					$newOrder = serialize($order);
				}	
				$todolistManager->updateTaskOrder($todolist_id, $newOrder);
				header('Location: ./todolist');
				exit;
			}
			else
			{
				$this->alert_failure('Vous ne pouvez pas ajouter de tâche à cette todolist', 'todolist');
			}
		}
		else
		{
			$this->alert_failure('Les données transmises sont incorrectes', 'todolist');
		}
	}

	/**
	 * Permet de supprimer une tâche d'une todolist (page todolist).
	 */
	public function processDeleteTask()
	{
		$project = $this->callProjectData();

		if (isset($_POST['task_id']) && !empty($_POST['task_id'])
			&& isset($_POST['todolist_id']) && !empty($_POST['todolist_id'])
			&& isset($_POST['deleteTask']) && $_POST['deleteTask'] == 'deleteTask')
		{
			$task_id     = (int) htmlspecialchars($_POST['task_id']);
			$todolist_id = (int) htmlspecialchars($_POST['todolist_id']);

			$todolistManager = new \App\model\TodolistManager();
			$verifTodolist   = $todolistManager->verifTodolistInProject($project, $todolist_id);

			if ($verifTodolist == 1) 
			{
				$todolistManager->deleteTask($task_id);
				$this->alert_success('La tâche a été supprimée avec succès !');
				header('Location: ./todolist');
				exit;
			}
			else
			{
				$this->alert_failure('Vous ne pouvez pas supprimer les tâches de cette todolist', 'todolist');
			}
		}
		else
		{
			$this->alert_failure('Les données transmises sont incorrectes', 'todolist');
		}
	}
}