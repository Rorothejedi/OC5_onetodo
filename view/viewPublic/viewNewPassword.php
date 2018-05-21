<?php 
	$title = 'OneToDo | Nouveau mot de passe';
	ob_start();
?>
	</header>

	<section class="section_connection">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<h1>Réinitialiser votre mot de passe OneToDo</h1><br>
					<p>Votre nouveau mot de passe doit contenir au moins 8 caractères et être composé de chiffres et de lettres minuscules et majuscules</p>
					<form action="processNewPassword&username=<?= $_GET['username'] ?>&key=<?= $_GET['key'] ?>" method="POST">
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
					<p class="text-muted">Si la mémoire vous reviens, vous pouvez <a href="connexion">essayer de vous reconnecter</a></p>
				</div>
			</div>
		</div>
	</section>


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePublic.php');
?>