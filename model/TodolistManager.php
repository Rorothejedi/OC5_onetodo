<?php
namespace App\model;

/**
 * Gére toutes les requêtes relatives à la page todolist et aux todolists en général.
 */
class TodolistManager
{
	
	/**
	 * Permet d'obtenir la liste complète des todolists d'un projet.
	 * @param  Project $project Objet contenant les informations du projet en cours de consultation.
	 * @return array            Renvoi un tableau (fetchAll) contenant toutes les données de la requête. 
	 */
	public function getTodolists(Project $project)
	{
		$data = App::getDb()->prepare('
			SELECT *
			FROM todolist
			WHERE id_project = :id_project
			ORDER BY completed, id DESC',
			['id_project' => $project->id()],
		true, false, false);

		return $data;
	}

	/**
	 * Permet d'obtenir la liste complète des tâches d'un projet.
	 * @param  Project $project Objet contenant les informations du projet en cours de consultation.
	 * @return array            Renvoi un tableau (fetchAll) contenant toutes les données de la requête. 
	 */
	public function getTasks(Project $project)
	{
		$data = App::getDb()->prepare('
			SELECT t.id, t.id_todolist, t.name, t.done
			FROM task t
			INNER JOIN todolist d ON d.id = t.id_todolist
			WHERE d.id_project = :id_project',
			['id_project' => $project->id()],
		true, false, false);

		return $data;
	}

	/**
	 * Permet d'obtenir une todolist d'après son identifiant.
	 * @param  int    $todolist_id Identifiant de la todolist à recupérer.
	 * @return object              Retourne un fetch avec les données d'une todolist.
	 */
	public function getTodolist($todolist_id)
	{
		$data = App::getDb()->prepare('
			SELECT *
			FROM todolist
			WHERE id = :todolist_id',
			['todolist_id' => $todolist_id],
		true, true, false);

		return $data;
	}

	/**
	 * Permet d'obtenir une tâche d'après son identifiant.
	 * @param  int    $task_id Identifiant de la tâche à recupérer.
	 * @return object          Retourne un fetch avec les données d'une tâche.
	 */
	public function getTask($task_id)
	{
		$data = App::getDb()->prepare('
			SELECT *
			FROM task
			WHERE id = :task_id',
			['task_id' => $task_id],
		true, true, false);

		return $data;
	}

	/**
	 * Permet d'ajouter une todolist à un projet.
	 * @param  Project $project Objet contenant les informations du projet en cours de consultation.
	 * @param string  $todolist_name Nom de la todolist à ajouter.
	 */
	public function addTodolist(Project $project, $todolist_name)
	{
		$data = App::getDb()->prepare('
			INSERT INTO todolist
				(id_project, name)
			VALUES
				(:id_project, :name)',
			['id_project'   => $project->id(),
			'name' => $todolist_name]);
	}

	/**
	 * Permet d'ajouter une tâche à une todolist.
	 * @param int    $todolist_id Identifiant de la todolist à laquelle ajouter la nouvelle tâche.
	 * @param string $task_name   Nom de la tâche à ajouter.
	 */
	public function addTask($todolist_id, $task_name)
	{
		$data = App::getDb()->prepare('
			INSERT INTO task
				(id_todolist, name)
			VALUES
				(:todolist_id, :task_name)',
			['todolist_id' => $todolist_id,
			'task_name'    => $task_name],
		false, false, false);

		$lastId = App::getDb()->query('
			SELECT MAX(id) AS id
			FROM task',
		true, true);

		return $lastId;
	}

	/**
	 * Permet de vérifier l'existence du todolist.
	 * @param  Project $project Objet contenant les informations du projet en cours de consultation.
	 * @param  string  $todolist_name Nom de la todolist à vérifier.
	 * @return int                    Retourne le nombre de résulat.
	 */
	public function verifTodolistExist(Project $project, $todolist_name)
	{
		$data = App::getDb()->prepare('
			SELECT * 
			FROM todolist 
			WHERE id_project = :id_project AND name = :name',
			['id_project'   => $project->id(),
			'name' => $todolist_name],
		true, false, true);

		return $data;
	}

	/**
	 * Permet de vérifier qu'une todolist est bien dans le projet en cours de consultation.
	 * @param  Project $project Objet contenant les informations du projet en cours de consultation.
	 * @param  int     $todolist_id Identifiant de la todolist à vérifier.
	 * @return int                    Retourne le nombre de résulat.
	 */
	public function verifTodolistInProject(Project $project, $todolist_id)
	{
		$data = App::getDb()->prepare('
			SELECT * 
			FROM todolist 
			WHERE id_project = :id_project AND id = :todolist_id',
			['id_project'   => $project->id(),
			'todolist_id' => $todolist_id],
		true, false, true);

		return $data;
	}

	/**
	 * Permet de mettre à jour l'ordre des lequel les tâches sont positionnées au sein d'une todolist.
	 * @param  int $todolist_id Identifiant de la todolist à mettre à jour.
	 * @param  string $order       Données sérialisée contenant un tableau donnant l'ordre des identifiants des tâches.
	 */
	public function updateTaskOrder($todolist_id, $order)
	{
		$data = App::getDb()->prepare('
			UPDATE todolist
			SET task_order = :order
			WHERE id = :todolist_id',
			['order' => $order,
			'todolist_id' => $todolist_id]
		);
	}

	/**
	 * Permet d'indiquer qu'une tâche à été effectuée.
	 * @param  int    $done    1 ou 0 (tâche effectuée ou pas effectué)
	 * @param  int    $task_id Identifiant de la tâche à mettre à jour.
	 */
	public function updateDoneTask($done, $task_id)
	{
		$data = App::getDb()->prepare('
			UPDATE task
			SET done = :done
			WHERE id = :task_id',
			['done'   => $done,
			'task_id' => $task_id]
		);
	}

	/**
	 * Permet de d'obtenir le pourcentage de completion d'une todoliste en divisant le nombre de tâche indiquée comme terminée par le nombre de tâche totale.
	 * @param  int $todolist_id Identifiant de la todolist à laquelle on calcul le pourcentage.
	 * @return int              Pourcentage de completion d'une todolist (tâches terminées * 100 / tâches totales).
	 */
	public function getDoneTasks($todolist_id)
	{
		$data = App::getDb()->prepare('
			SELECT *
			FROM task
			WHERE id_todolist = :todolist_id',
			['todolist_id'   => $todolist_id],
		true, false, false);

		$dataBis = App::getDb()->prepare('
			SELECT *
			FROM task
			WHERE id_todolist = :todolist_id
			AND done = 1',
			['todolist_id'   => $todolist_id],
		true, false, false);

		$countData = count($dataBis);
		$countDataBis = count($data);

		if ($countData > 0) 
		{
			$percentage = ($countDataBis * 100) / $countData;

			if ($percentage == 100) 
			{
				$completed = 1;
			}
			else
			{
				$completed = 0;
			}

			$dataTier = App::getDb()->prepare('
				UPDATE todolist
				SET completed = :completed
				WHERE id = :todolist_id',
				['todolist_id' => $todolist_id,
				'completed'    => $completed]);

			return $percentage;
		}
	}


	/**
	 * Permet la suppression d'une todolist et des tâches qui lui sont associées.
	 * @param  int $todolist_id Identifiant de la todolist à supprimer.
	 */
	public function deleteTodolist($todolist_id)
	{
		$data = App::getDb()->prepare('
			DELETE FROM todolist 
			WHERE id = :todolist_id',
			['todolist_id' => $todolist_id]
		);
	}

	/**
	 * Permet de supprimer une tâche d'une todolist.
	 * @param  int $task_id Identifiant de la tâche à supprimer.
	 */
	public function deleteTask($task_id)
	{
		$data = App::getDb()->prepare('
			DELETE FROM task 
			WHERE id = :task_id',
			['task_id' => $task_id]
		);
	}
}