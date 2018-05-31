<?php 
namespace App\controller;

/**
 * Class ControllerProject
 * 
 */
class ControllerProject extends Alert
{
	
	public function __construct()
	{
		if (empty($_SESSION['user_id']) && empty($_SESSION['user_username'])) 
		{ 
			header('Location: ./connexion');
			exit();
		}
		// Vérification du droit d'accéder au projet
		if($this->verifProject() === 0)
		{
			$this->alert_failure('Vous n\'êtes pas autorisé à accéder à ce projet', '../dashboard');
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
	 * [callProjectData description]
	 * @return [type] [description]
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
		$project 		= $this->callProjectData();
		$userData       = $this->callUserData();
		$notSeenMessage = $this->callNotSeenMessage();
		require('./view/viewProject/viewHomeProject.php');
	}

	public function displayTodolist($slug)
	{
		$access 		= $this->callAccessToProject();
		$projects       = $this->callUserProjects();
		$project 		= $this->callProjectData();
		$userData       = $this->callUserData();
		$notSeenMessage = $this->callNotSeenMessage();
		require('./view/viewProject/viewTodolist.php');
	}

	public function displayWiki($slug)
	{
		$access 		= $this->callAccessToProject();
		$projects       = $this->callUserProjects();
		$project 		= $this->callProjectData();
		$userData       = $this->callUserData();
		$notSeenMessage = $this->callNotSeenMessage();
		require('./view/viewProject/viewWiki.php');
	}

	public function displayProjectUsers($slug)
	{
		$access 		= $this->callAccessToProject();
		$projects       = $this->callUserProjects();
		$project 		= $this->callProjectData();
		$userData       = $this->callUserData();
		$notSeenMessage = $this->callNotSeenMessage();
		require('./view/viewProject/viewProjectUsers.php');
	}

	public function displayProjectSettings($slug)
	{
		$access 		= $this->callAccessToProject();
		$projects       = $this->callUserProjects();
		$project 		= $this->callProjectData();
		$userData       = $this->callUserData();
		$notSeenMessage = $this->callNotSeenMessage();
		require('./view/viewProject/viewProjectSettings.php');
	}

	// ------- PROCESS -------
	
	/**
	 * Permet de supprimer le projet sélectionné.
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
			exit();
		}
		else
		{
			$this->alert_failure('Les données transmises sont incorrectes', '/projet/' . $project->link() . '/parametres');
		}
	}

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

			if (strlen($projectName) <= 70) 
			{
				$projectManager = new \App\model\ProjectManager();
				$verifExistProjectName = $projectManager->existOtherProject($projectName, $project->id());

				if ($verifExistProjectName == 0) 
				{
					if ($statusProject === 0 || $statusProject === 1) 
					{
						if (preg_match('/#([a-f0-9]{3}){1,2}\b/i', $colorProject))
						{
							$link = strtolower(str_replace(' ', '-', $projectName));
							$modifiedProject = new \App\model\Project([
								'name'        => $projectName,
								'link'		  => $link,
								'status'      => $statusProject,
								'color'       => $colorProject,
								'description' => $descriptionProject
							]);

							$projectManager->editProject($project->id(), $modifiedProject);
							$actualProject = $projectManager->getProject($modifiedProject);


							$this->alert_success('Votre projet "<strong>' . $projectName . '</strong>" a été modifié avec succès !');
							header('Location: ' . \App\model\App::getDomainPath() . '/projet/' . $actualProject->link() .'/parametres');
							exit();
						}
						else
						{
							$this->alert_failure('La couleur de votre projet n\'est pas valide', 'parametres');
						}
					}
					else
					{
						$this->alert_failure('Le status de votre projet n\'est pas valide', 'parametres');
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
}