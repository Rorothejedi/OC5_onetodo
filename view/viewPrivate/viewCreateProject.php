<?php 
	$title = 'OneToDo | Nouveau projet';
	ob_start();
?>
	<div class="container-fluid">
		<nav aria-label="breadcrumb">
  			<ol class="breadcrumb">
    			<li class="breadcrumb-item"><a href="dashboard">Tableau de bord</a></li>
    			<li class="breadcrumb-item active" aria-current="Nouveau projet">Nouveau projet</li>
  			</ol>
		</nav>
		<br>
		<div class="row">
			<div class="col-lg-8">
				<div class="jumbotron">
					<div class="page-header">
						<h5>Avant de commencer, dites-nous tout sur votre projet ...</h5>
						<hr>
					</div>
					<form action="processNewProject" method="POST">
						<div class="form-group">
							<label for="projectName">Nom du projet <em class="text-muted small">(70 caractères maximum)</em></label>
							<input id="projectName" name="projectName" type="text" class="form-control" maxlength="70" required>
						</div>
						<div class="form-row justify-content-between">
							<div class="form-group col-lg-5">
								<label for="statusProject">Status</label>
								<select id="statusProject" name="statusProject" class="form-control">
									<option value="0" selected>Privé (par défaut)</option>
									<option value="1">Ouvert</option>
								</select>
							</div>
							<div class="form-group col-lg-6">
								<label for="colorProject">Couleur</label>
								<input id="colorProject" name="colorProject" type="color" list="colors" value="#306BA2" class="form-control">
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
							<textarea id="descriptionProject" name="descriptionProject" rows="3" class="form-control" placeholder="Facultative" maxlength="180"></textarea>
							<p class="charactersCount hidden text-muted">fdsfdf</p>
							<br class="charactersCountFillIn">
						</div>
						<br>
						<button type="submit" class="btn btn-primary">Créer le projet</button>
					</form>
				</div>
			</div>
		</div>
	</div>


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePrivate.php');
?>	