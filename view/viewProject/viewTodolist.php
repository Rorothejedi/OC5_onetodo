<?php 
	$title = 'OneToDo | Liste(s) des tâches';
	ob_start();
	require('projectNavbar.php');
?>

	<div class="container-fluid">
		<div class="row content-project">
			<div class="col-lg-12">
				<div class="d-flex">
					<h4 class="tileName">Todolist</h4>
				</div>
				<div class="row">
					<div class="col-xl-8">
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
						<div class="jumbotron">

							<?php foreach ($todolists as $key => $todolist): ?>

							<div class="d-flex pb-4">
								<a href="#todolist-<?= $todolist->id ?>" data-toggle="collapse" aria-expanded="<?php if($key == 0){echo'false';}else{echo'true';} ?>" class="text-light rounded pl-5 mr-3 activeCollapse d-flex align-items-center justify-content-between" style="background-color: var(--second-color); width: 95%;height: 50px;">
									<?= $todolist->name ?>
									<i class="fas fa-caret-down rotate fa-lg mr-4 ml-4 <?php if($key == 0){echo'down';} ?>"></i>
								</a>
								<button class="btn btn-light rounded-circle pr-3 pl-3">
									<i class="fas fa-ellipsis-h"></i>
								</button>
								<form action="processOrder" method="POST" id="formOrder">
									<input type="hidden" name="todolist_id" value="<?= $todolist->id ?>">
									<input type="hidden" name="serializedOrder" id="serializedOrder" value=''>
								</form>
							</div>


							<div class="collapse border-left border-dark todolistCollapse <?php if($key == 0){echo'show';} ?>" id="todolist-<?= $todolist->id ?>" style="width: 100%; padding-left: 3%; margin-left: 2%; ">

								<?php 
									if ($todolist->task_order):
										$order = unserialize($todolist->task_order);
										foreach ($order as $keyA => $value):
											foreach ($tasks as $keyB => $task): 
												if ($order[$keyA] == $task->id):
													if ($task->id_todolist == $todolist->id):
								?>


							
								<div class="mb-3" id="<?= $task->id ?>">
									<div class="rounded d-flex align-items-center justify-content-between" style="background-color: lightgrey; width: 100%;height: 40px; cursor: move;">
										<div class="d-flex">
											<form action="processDoneTask" method="POST">
												<input type="hidden" name="done_task_id" value="<?= $task->id ?>">
												<input type="hidden" name="isDoneTask"  value="<?php if($task->done == 0){echo 1;}else{echo 0;} ?>">
												<input type="checkbox" name="checkboxTask" title="Terminé" data-toggle="tooltip" data-trigger="hover" class="ml-3 mr-3" onChange="this.form.submit()" <?php if ($task->done == 1) {echo 'checked="checked"';} ?>>
											</form>
											<?= $task->name ?>
										</div>
										<div>
											<i class="fas fa-ellipsis-h ml-3 mr-3 dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer; color: var(--main-color) !important"></i>
										  	<div class="dropdown-menu">
										    	<a class="dropdown-item" href="#"><i class="fas fa-trash-alt"></i> Supprimer cette tâche</a>
										    </div>
										</div>
									</div>
								</div>

								<?php 
													endif;
												endif;
											endforeach; 
										endforeach; 
									endif;
								?>
								
								<!-- <div class="mb-3" id="2">
									<div class="rounded d-flex align-items-center justify-content-between" style="background-color: lightgrey; width: 100%;height: 40px; cursor: move;">
										<div class="d-flex">
											<form action="#" method="POST">
												<input type="checkbox" title="En cours" data-toggle="tooltip" data-trigger="hover" class="ml-3">
												<input type="checkbox" title="Terminé" data-toggle="tooltip" data-trigger="hover" class="ml-2 mr-4">
											</form>
											Tâche numéro 2
										</div>
										<div>
											<i class="fas fa-ellipsis-h ml-3 mr-3 dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer; color: var(--main-color) !important"></i>
										  	<div class="dropdown-menu">
										    	<a class="dropdown-item" href="#"><i class="fas fa-trash-alt"></i> Supprimer cette tâche</a>
										  </div>
										</div>
									</div>
								</div> -->

								<!-- <div class="mb-3" id="3">
									<div class=" rounded d-flex align-items-center justify-content-between test3"  style="background-color: lightgrey; width: 100%;height: 40px; cursor: move;">
										<div class="d-flex">
											<form action="#" method="POST">
												<input type="checkbox" title="En cours" data-toggle="tooltip" data-trigger="hover" class="ml-3">
												<input type="checkbox" title="Terminé" data-toggle="tooltip" data-trigger="hover" class="ml-2 mr-4">
											</form>
											Tâche numéro 3
										</div>
										<div>
											<i class="fas fa-ellipsis-h ml-3 mr-3 dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer; color: var(--main-color) !important"></i>
										  	<div class="dropdown-menu">
										    	<a class="dropdown-item" href="#"><i class="fas fa-trash-alt"></i> Supprimer cette tâche</a>
										  </div>
										</div>
									</div>
								</div> -->
							</div>

							<?php endforeach; ?>


						</div>
					</div>
					<div class="col-xl-4">
						<a href="#" class="text-center button_create_todolist">
							<div class="jumbotron messages_content new_conversation_button">
								<h5>Nouvelle Todolist <i class="fas fa-plus-square"></i></h5>
							</div>
						</a>
						<div class="jumbotron">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php 
	$content = ob_get_clean();
	require('./view/template/templateProject.php');
?>