<?php 
	$title = 'OneToDo | Paramètres utilisateur';
	ob_start();

	$avatar = new \App\model\Avatar($userData->email(), 80);
?>

	<div class="container-fluid">
		<nav aria-label="breadcrumb">
  			<ol class="breadcrumb">
    			<li class="breadcrumb-item"><a href="dashboard">Tableau de bord</a></li>
    			<li class="breadcrumb-item active" aria-current="Paramètres utilisateur">Paramètres</li>
  			</ol>
		</nav>
		<br>
		<div class="row">
			<div class="col-lg-8 col-md-12">
				<div class="jumbotron">
					<form action="processEditUser" method="POST" id="main-form">
						<div class="form-group">
							<div class="d-flex">
								<div class="text-center align-self-center">
									<?= $avatar->generateGravatar() ?>
								</div>
								<div class="col-lg-8 align-self-center">
									<p>Pour ajouter ou modifier une image de profil, vous pouvez créer ou vous connecter à un compte <a href="https://fr.gravatar.com/" target="_blank">Gravatar</a>.</p>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="username">Nom d'utilisateur</label>
							<input type="text" class="form-control" id="username" name="username" value="<?= $userData->username() ?>" required>
							<small class="text-muted small_username">Votre nom d'utilisateur doit avoir entre 2 et 25 caractères.</small>
						</div>
						<div class="form-group">
							<label for="email">Adresse email</label>
							<input type="email" class="form-control" id="email" name="email" value="<?= $userData->email() ?>" required>
						</div>
						<div class="form-row">
							<div class="col-lg-6">
								<label for="password">Nouveau mot de passe</label>
								<input type="password" class="form-control mb-2" id="password" name="password">
							</div>
							<div class="col-lg-6">
								<label for="confirm_password">Confirmer le nouveau mot de passe</label>
								<input type="password" class="form-control mb-2" id="confirm_password" name="confirm_password">
							</div>
						</div>
						<small class="text-muted small_pass">Un mot de passe doit contenir 8 caractères minimum, être composé de chiffres et de lettres minuscules et majuscules.</small>
						<br><br>
						<div class="form-group">
							<button type="submit" class="btn btn-primary" name="editUser" value="editUser" data-confirm="Etes-vous certain de vouloir sauvegarder les modifications effectuées ?">Modifier mes information</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		

	</div>


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePrivate.php');
?>