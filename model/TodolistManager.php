<?php
namespace App\model;


/**
 * Class TodolistManager
 * 
 */
class TodolistManager
{
	
	public function getTodolists(Project $project)
	{
		$data = App::getDb()->prepare('
			SELECT *
			FROM todolist
			WHERE id_project = :id_project',
			['id_project' => $project->id()],
		true, false, false);

		return $data;
	}

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



	//Suppression d'une todolist
	//Suppression d'une task
	//
	//Ajout d'une task
	//
	//Done d'une task

}