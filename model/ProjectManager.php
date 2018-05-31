<?php
namespace App\model;

/**
 * Class ProjectManager
 * 
 */
class ProjectManager
{

	/**
	 * Permet de récupérer les projets liés à un utilisateur.
	 * @param  User   $user Objet User pour identifier les projets qui lui sont liés.
	 * @return array       	Tableau contenant les données des projets concernant l'utilisateur passé en paramètre.
	 */
	public function getUserProjects(User $user)
	{
		$data = App::getDb()->prepare('
			SELECT p.name, p.link, p.status, p.color, p.description,
			a.id_user, a.id_project, a.access,
			u.username, u.email
			FROM project p
			RIGHT JOIN access a ON p.id = a.id_project
			RIGHT JOIN user u ON a.id_user = u.id
			WHERE u.id = :id',
			['id' => $user->id()],
		true, false, false);

		return $data;
	}

	/**
	 * Permet d'obtenir toutes les données d'un projet.
	 * @param  Project $project Cet objet contient certaines des données unique du projet (id ou name).
	 * @return object           Renvoi l'object Project avec toutes les données du projet passé en paramètre.
	 */
	public function getProject(Project $project)
	{
		$data = App::getDb()->prepare('
			SELECT * 
			FROM project 
			WHERE id = :id_project OR name = :name_project OR link = :link_project',
			['id_project'  => $project->id(),
			'name_project' => $project->name(),
			'link_project' => $project->link()],
		true, true, false);

		return new \App\model\Project($data);
	}

	public function existProject($name)
	{
		$link = strtolower(str_replace(' ', '-', $name));
		$data = App::getDb()->prepare('
			SELECT * FROM project WHERE name = :name_project OR link = :link',
			['name_project' => $name,
			'link'          => $link],
		true, false, true);

		return $data;
	}


	public function existOtherProject($name, $id_project)
	{
		$link = strtolower(str_replace(' ', '-', $name));
		$data = App::getDb()->prepare('
			SELECT * FROM project WHERE (name = :name_project OR link = :link) AND id != :id_project',
			['name_project' => $name,
			'link'          => $link,
			'id_project'    => $id_project],
		true, false, true);

		return $data;
	}



	/**
	 * Permet de créer un nouveau projet.
	 * @param Project $project Objet contenant les informations du projet à créer.
	 */
	public function addProject(Project $project)
	{
		$data = App::getDb()->prepare('
			INSERT INTO project
				(name, link, status, color, description)
			VALUES
				(:name, :link, :status, :color, :description)',
			['name'       => $project->name(),
			'link'        => $project->link(),
			'status'      => $project->status(),
			'color'       => $project->color(),
			'description' => $project->description()]
		);
	}

	public function addUserInProject($id_user, $id_project, $access)
	{
		$data = App::getDb()->prepare('
			INSERT INTO access
				(id_user, id_project, access)
			VALUES
				(:id_user, :id_project, :access)',
			['id_user'   => $id_user,
			'id_project' => $id_project,
			'access'     => $access]
		);
	}

	/**
	 * Permet de vérifier si un utilisateur est autorisé à avoir accès au projet.
	 * @param  int    $id_user      Identifiant de l'utilisateur en cours.
	 * @param  string $link_project Lien du projet.
	 * @return int                  Renvoi 1 si l'utilisateur en cours correspond au projet sélectionné. Sinon renvoi 0.
	 */
	public function verifAccessProject($id_user, $link_project)
	{
		$data = App::getDb()->prepare('
			SELECT * 
			FROM access
			WHERE id_user = :id_user 
			AND id_project = (SELECT id FROM project WHERE link = :link_project)',
			['id_user'     => $id_user,
			'link_project' => $link_project],
		true, false, true);

		return $data;
	}

	/**
	 * Permet de récupérer les droits d'accès de l'utilisateur en cours sur le projet passé en paramètre.
	 * @param  User    $user    Objet contenant les informations de l'utilisateur en cours.
	 * @param  Project $project Objet contenant les informations du projet en cours de consultation.
	 * @return array            Tableau (fetch) contenant la valeur d'accès de l'utilisateur pour ce projet.
	 */
	public function getUserAccessProject(User $user, Project $project)
	{
		$data = App::getDb()->prepare('
			SELECT access FROM access WHERE id_user = :id_user AND id_project = :id_project',
			['id_user' => $user->id(),
			'id_project' => $project->id()],
		true, true, false);

		return $data;
	}

	/**
	 * Permet de supprimer le projet sélectionné.
	 * @param  Project $project Objet contenant les informations du projet en cours de consultation.
	 */
	public function deleteProject(Project $project)
	{
		$data = App::getDb()->prepare('
			DELETE a, p
			FROM project p
			INNER JOIN access a ON p.id = a.id_project
			WHERE a.id_project = :id',
			['id' => $project->id()]
		);
	}

	/**
	 * Permet d'éditer les informations (nom, lien, status, couleur et description) du projet sélectionné.
	 * @param  int     $id_project Identifiant du projet à modifier.
	 * @param  Project $project    Objet contenant les informations du projet en cours de consultation.
	 */
	public function editProject($id_project, Project $project)
	{
		$data = App::getDb()->prepare('
			UPDATE project
			SET name = :name, link = :link, status = :status, color = :color, description = :description
			WHERE id = :id',
			['id'         => $id_project,
			'name'        => $project->name(),
			'link'        => $project->link(),
			'status'      => $project->status(),
			'color'       => $project->color(),
			'description' => $project->description()]
		);
	}

	/**
	 * Permet d'éditer le wiki du projet sélectionné.
	 * @param  Project $project Objet contenant les informations du projet en cours de consultation.
	 * @param  string  $wiki    Chaine de caractères contenant le wiki du projet en cours de consultation.
	 */
	public function editWiki(Project $project, $wiki)
	{
		$data = App::getDb()->prepare('
			UPDATE project
			SET wiki = :wiki
			WHERE id = :id',
			['id' => $project->id(),
			'wiki' => $wiki]
		);
	}
}