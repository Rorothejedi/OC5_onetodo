<?php 
	$title = 'OneToDo | Inscription';
	ob_start();
?>
	</header>

	<section class="section_connection">
		<div class="container pb-3">
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<h1>Créer un compte <em>ONETODO</em></h1>
					<p>ou <a href="connexion">se connecter à votre compte</a></p>
					<form action="processRegistration" method="POST">
						<div class="form-group">
							<label for="username">Nom d'utilisateur</label>
							<input id="username" type="text" class="form-control" name="username" value="<?php if(!empty($_SESSION['save_username'])){echo $_SESSION['save_username'];} ?>" maxlength="25" required>
							<small class="text-muted small_username">Veuillez saisir un nom d'utilisateur entre 2 et 25 caractères</small>
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input id="email" type="email" class="form-control" name="email" value="<?php if(!empty($_SESSION['save_email'])){echo $_SESSION['save_email'];} ?>" required>
							<small class="text-muted small_email">Veuillez saisir une adresse e-mail valide</small>
						</div>
						<div class="form-group">
							<label for="password">Mot de passe</label>
							<input id="password" type="password" class="form-control" name="password" required>
							<label for="confirm_password">Confimer le mot de passe</label>
							<input id="confirm_password" type="password" class="form-control"  name="confirm_password" required>
							<small class="text-muted small_pass">Veuillez saisir et confirmer le mot de passe que vous avez choisi, celui-ci doit contenir 8 caractères minimum, être composé de chiffres et de lettres minuscules et majuscules</small>
						</div>
						<div class="form-group">
							<div class="form-check">
							  	<label class="form-check-label">
							    	<input type="checkbox" name="consent" class="form-check-input">
							    	J'ai lu et j'accepte <a href="mentions_legales">la politique d'utilisation des données</a>
							  	</label>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-lg btn-block">Créer un nouveau compte</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePublic.php');
?>