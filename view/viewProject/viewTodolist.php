<?php 
	$title = 'Liste(s) des tâches';
	ob_start();
	require('projectNavbar.php');
?>

	<div class="container-fluid">
		<div class="d-flex">
			<h4 class="tileName">Todolist</h4>
		</div>
		<?php if($access->access <= 2): ?>
			<div class="row">
				<div class="col-xl-4 col-lg-12 d-xl-none">
					<a href="#" class="text-center button_create_todolist">
						<div class="jumbotron messages_content new_conversation_button">
							<h5>Nouvelle Todolist <i class="fas fa-plus-square"></i></h5>
						</div>
					</a>
				</div>
			</div>
			<?php endif; ?>
		<div class="row">
			<div class="col-xl-8 col-lg-12">
				<div class="jumbotron hidden createNewTodolist">
					<form action="processAddTodolist" method="POST">
						<div class="form-row">
							<div class="col-lg-10">
								<div class="form-group">
									<input type="hidden" name="newTodolist" value="newTodolist">
									<input name="nameTodolist" type="text" class="form-control" maxlength="50" placeholder="Nom de la todolist">
								</div>
							</div>
							<div class="col-lg-2">
								<button type="submit" class="btn btn-primary btn-block">Créer</button>
							</div>
						</div>
					</form>
				</div>
				<h4 class="tileNameBis hidden">Todolist</h4>

				<?php 
					if (count($todolists) == 0) 
					{
						echo '<div class="jumbotron"><p>La todolist de <strong>' . $project->name() . '</strong> est vide...</p></div>';
					}
					foreach ($todolists as $key => $todolist):
						$percentage = $todolistManager->getDoneTasks($todolist->id);

				?>

				<div class="jumbotron" style="<?php if ($percentage == 100) {echo "background-color: #C3E6CB";} ?>">

					<div class="d-flex pb-4">
						<a href="#todolist-<?= $todolist->id ?>" data-toggle="collapse" aria-expanded="<?php if ($percentage == 100) {echo "true";}else{echo 'false';} ?>" class="header-todolist text-light rounded pl-5 mr-3 activeCollapse d-flex align-items-center justify-content-between <?php if ($percentage == 100) {echo "collapsed";} ?>">
							<?= $todolist->name ?>
							<i class="fas fa-caret-down rotate fa-lg mr-4 ml-4 down"></i>
						</a>
						<?php if($access->access <= 2): ?>
						<button class="btn btn-dark dropdown-toggle button-more-todolist" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-ellipsis-h ml-3 mr-3"></i>
						</button>
					  	<div class="dropdown-menu">
					  		<a href="" class="dropdown-item button_add_task" id="button_add_task-<?= $todolist->id ?>">
					  			<i class="fas fa-plus icon-plus-task"></i> Ajouter une tâche
					  		</a>
					  		<div class="dropdown-divider"></div>
					  		<form action="processDeleteTodolist" method="POST" id="deleteTodolistForm<?= $todolist->id ?>">
					  			<input type="hidden" name="deleteTodolist" value="deleteTodolist">
					  			<input type="hidden" name="todolist_id" value="<?= $todolist->id ?>">
						    	<a class="dropdown-item" href="javascript: $('#deleteTodolistForm<?= $todolist->id ?>').submit();" data-confirm="Voulez-vous vraiment supprimer cette todolist ?">
						    		<i class="fas fa-times"></i> Supprimer la todolist
						    	</a>
					  		</form>
					    </div>
					<?php endif; ?>
								
						<form action="processOrder" method="POST" id="formOrder-<?= $todolist->id ?>">
							<input type="hidden" name="todolist_id" value="<?= $todolist->id ?>">
							<input type="hidden" name="serializedOrder" id="serializedOrder-<?= $todolist->id ?>" value=''>
						</form>
					</div>

					<div class="hidden" id="block_add_task-<?= $todolist->id ?>">
						<form action="processAddTask" method="POST">
							<div class="form-row">
								<div class="col-lg-8">
									<div class="form-group">
										<input type="hidden" name="addTask" value="addTask">
										<input type="hidden" name="todolist_id" value="<?= $todolist->id ?>">
										<input type="text" name="nameTask" placeholder="Nom de la tâche" class="form-control">
									</div>
								</div>
								<div class="col-lg-2">
									<button class="btn btn-block btn-primary" type="submit">Créer</button>
								</div>
								<div class="col-lg-2">
									<button class="btn btn-block btn-secondary button_cancel_add_task" id="button_cancel_add_task-<?= $todolist->id ?>">Annuler</button>
								</div>
							</div>
						</form>
					</div>

					<div class="block-content-todolist collapse border-left border-dark <?php if($access->access <= 2){echo 'todolistCollapse';} ?> <?php if ($percentage != 100) {echo "show";} ?>" id="todolist-<?= $todolist->id ?>">

						<?php 
							if ($todolist->task_order):
								$order = unserialize($todolist->task_order);
								foreach ($order as $keyA => $value):
									foreach ($tasks as $keyB => $task): 
										if ($value == $task->id):
											if ($task->id_todolist == $todolist->id):
						?>

						<div class="pb-3" id="<?= $task->id ?>">
							<div class="task-block-content rounded d-flex align-items-center justify-content-between" style="<?php if($access->access <= 2){echo 'cursor: move';}else{echo "cursor: default";} ?>">
								<div class="d-flex">
									<?php if($access->access <= 2): ?>
									<form action="processDoneTask" method="POST">
										<input type="hidden" name="done_task_id" value="<?= $task->id ?>">
										<input type="hidden" name="isDoneTask"  value="<?php if($task->done == 0){echo 1;}else{echo 0;} ?>">
										<input type="checkbox" name="checkboxTask" title="Terminé" data-toggle="tooltip" data-trigger="hover" class="ml-3 mr-3" onChange="this.form.submit()" <?php if ($task->done == 1) {echo 'checked="checked"';} ?>>
									</form>
									<?php else: ?>
									<div class="fakeCheckbox"></div>
									<?php endif; ?>
									<span class="text-content-task">
										<?php 
											if ($task->done == 0)
											{
												echo $task->name;
											}
											else
											{
												echo '<s>' . $task->name . '</s>';
											}
										?>
									</span>
								</div>
								<?php if($access->access <= 2): ?>
								<div>
									<div class="ml-3 mr-3 dropdown-toggle button-more-task" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
										<i class="fas fa-ellipsis-h"></i>
									</div>
								  	<div class="dropdown-menu">
								  		<form action="processDeleteTask" method="POST" id="deleteTaskForm<?= $task->id ?>">
					  						<input type="hidden" name="deleteTask" value="deleteTask">
					  						<input type="hidden" name="todolist_id" value="<?= $todolist->id ?>">
					  						<input type="hidden" name="task_id" value="<?= $task->id ?>">
								    		<a class="dropdown-item" href="javascript: $('#deleteTaskForm<?= $task->id ?>').submit();" data-confirm="Voulez-vous vraiment supprimer cette tâche ?">
								    			<i class="fas fa-trash-alt"></i> Supprimer la tâche
								    		</a>
								    	</form>
								    </div>
								</div>
								<?php endif; ?>
							</div>
						</div>

						<?php 

											endif;
										endif;
									endforeach; 
								endforeach; 
							endif;
						?>
					</div>
				</div>

				<?php endforeach; ?>

			</div>
			<?php if($access->access <= 2): ?>
			<div class="col-xl-4 col-lg-12 d-none d-xl-block">
				<a href="#" class="text-center button_create_todolist">
					<div class="jumbotron messages_content new_conversation_button">
						<h5>Nouvelle Todolist <i class="fas fa-plus-square"></i></h5>
					</div>
				</a>
			</div>
			<?php endif; ?>
		</div>
	</div>

<?php 
	$content = ob_get_clean();
	require('./view/template/templateProject.php');
?>