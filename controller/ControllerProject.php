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


	/**
	 * Méthode d'affichage de l'accueil des projets.
	 * @param  string $slug Link du projet.
	 */
	public function displayHomeProject($slug)
	{
		$projects       = $this->callUserProjects();
		$project 		= $this->callProjectData();
		$userData       = $this->callUserData();
		$notSeenMessage = $this->callNotSeenMessage();
		require('./view/viewProject/viewHomeProject.php');
	}

	public function displayTodolist($slug)
	{
		$projects       = $this->callUserProjects();
		$project 		= $this->callProjectData();
		$userData       = $this->callUserData();
		$notSeenMessage = $this->callNotSeenMessage();
		require('./view/viewProject/viewTodolist.php');
	}

	public function displayWiki($slug)
	{
		$projects       = $this->callUserProjects();
		$project 		= $this->callProjectData();
		$userData       = $this->callUserData();
		$notSeenMessage = $this->callNotSeenMessage();
		require('./view/viewProject/viewWiki.php');
	}

	public function displayProjectUsers($slug)
	{
		$projects       = $this->callUserProjects();
		$project 		= $this->callProjectData();
		$userData       = $this->callUserData();
		$notSeenMessage = $this->callNotSeenMessage();
		require('./view/viewProject/viewProjectUsers.php');
	}

	public function displayProjectSettings($slug)
	{
		$projects       = $this->callUserProjects();
		$project 		= $this->callProjectData();
		$userData       = $this->callUserData();
		$notSeenMessage = $this->callNotSeenMessage();
		require('./view/viewProject/viewProjectSettings.php');
	}
}