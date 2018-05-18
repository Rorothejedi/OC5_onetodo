<?php 
	$title = 'OneToDo | Mot de passe oublié';
	ob_start();
?>
	</header>

	<section class="section_connection">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<h1>Réinitialiser votre mot de passe OneToDo</h1><br>

					<?php 

						if (!empty($_GET['username']) && !empty($_GET['key'])) 
						{

					?>

					<p>Votre nouveau mot de passe doit contenir au moins 8 caractères et être composé de chiffres et de lettres minuscules et majuscules</p>
					<form action="proccesssNewPassword" method="POST">
						<div class="form-group">
							<label for="password">Nouveau mot de passe</label>
							<input id="password" type="password" class="form-control" name="password" required>
							<label for="confirm_password">Confirmer le mot de passe</label>
							<input id="confirm_password" type="password" class="form-control" name="confirm_password" required>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-lg btn-block">Confirmer</button>
						</div>
					</form>

					<?php
	
						}
						else
						{

					?>
					
					<p>Indiquez votre adresse mail et nous vous enverrons un lien pour réinitialiser votre mot de passe</p>
					<form action="processForgottenPassword" method="POST">
						<div class="form-group">
							<label for="email">Email</label>
							<input id="email" type="email" class="form-control" name="email" required>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-lg btn-block">Soumettre</button>
						</div>
					</form>

					<?php 

						}

					 ?>
					
					<p class="text-muted">Si la mémoire vous reviens, vous pouvez <a href="connexion">essayer de vous reconnecter</a></p>
				</div>
			</div>
		</div>
	</section>


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePublic.php');
?>