<?php
namespace App\model;

/**
 * Class ProjectManager
 * 
 */
class ProjectManager
{

	/**
	 * [getProjects description]
	 * @param  User   $user Objet User pour identifier les projets qui lui sont liés.
	 * @return array       	Tableau contenant les données des projets concernant l'utilisateur passé en paramètre.
	 */
	public function getUserProjects(User $user)
	{
		$data = App::getDb()->prepare('
			SELECT * FROM project p
			RIGHT JOIN access a ON p.id = a.id_project
			RIGHT JOIN user u ON a.id_user = u.id
			WHERE u.id = :id',
			['id' => $user->id()],
		true, false, false);

		return $data;
	}
}