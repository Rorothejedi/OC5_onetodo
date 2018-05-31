<?php 
	$title = 'OneToDo | Paramètres du projet';
	ob_start();
	require('projectNavbar.php');
?>

	<div class="container-fluid">
		<div class="row content-project">
			<div class="col-lg-8 col-md-12">
				<h4>Paramètres du projet</h4>
				<div class="jumbotron">
					<form action="processEditProject" method="POST" id="main-form">
						<div class="form-group">
							<label for="nameProject">Nom du projet <em class="text-muted small">(70 caractères maximum)</em></label>
							<input id="nameProject" name="nameProject" type="text" class="form-control" value="<?= $project->name() ?>" disabled>
						</div>
						<div class="form-row justify-content-between">
							<div class="form-group col-lg-5">
								<label for="statusProject">Status</label>
								<select id="statusProject" name="statusProject" class="form-control" disabled>
									<option value="0" <?php if ($project->status() == 0) {echo 'selected';} ?>>Privé (par défaut)</option>
									<option value="1" <?php if ($project->status() == 1) {echo 'selected';} ?>>Ouvert</option>
								</select>
							</div>

							<div class="form-group col-lg-6">
								<label for="colorProject">Couleur</label>
								<input id="colorProject" name="colorProject" type="color" list="colors" value="<?= $project->color() ?>" class="form-control" disabled>
								<datalist id="colors">
									<option>#2c3e50</option>
									<option>#34495e</option>
									<option>#27ae60</option>
									<option>#16a085</option>
									<option>#408080</option>
									<option>#2980b9</option>
									<option>#306BA2</option>
									<option>#9b59b6</option>
									<option>#8e44ad</option>
									<option>#e74c3c</option>
									<option>#c0392b</option>
									<option>#ff8000</option>
								</datalist>
							</div>
						</div>
						<div class="form-group">
							<label for="descriptionProject">Description <em class="text-muted small">(180 caractères maximum)</em></label>
							<textarea id="descriptionProject" name="descriptionProject" rows="3" class="form-control" maxlength="180"  disabled><?= $project->description() ?></textarea>
							<p class="charactersCount hidden text-muted">fdsfdf</p>
							<br class="charactersCountFillIn">
						</div>
						<br>
						<button type="button" class="btn btn-dark button-edit-project-disabled">Modifier les informations concernant le projet ?</button>
						<button type="submit" class="btn btn-primary button-edit-project hidden" data-confirm="Etes-vous sûr de vouloir modifier les informations relatives à votre projet ?">Modifier les informations</button>
					</form>
				</div>
			</div>
			<div class="col-lg-4 col-md-12">
				<h4>Paramètres avancés</h4>
				<div class="jumbotron">
					<form action="processDeleteProject" method="POST" id="form-delete-project">
						<div class="form-group">
							<input type="hidden" name="deleteProject" value="deleteProject">
							<button type="submit" class="btn btn-danger" data-confirm-delete="">Supprimer définitivement ce projet</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

<?php 
	$content = ob_get_clean();
	require('./view/template/templateProject.php');
?>