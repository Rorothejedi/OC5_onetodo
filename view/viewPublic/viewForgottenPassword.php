<?php 
	$title = 'Mot de passe oublié';
	ob_start();
?>
	</header>

	<section class="section_connection">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<h1>Réinitialiser votre mot de passe <em>ONETODO</em></h1><br>
					<p>Indiquez votre adresse mail et nous vous enverrons un lien pour réinitialiser votre mot de passe.</p>
					<form action="processForgottenPassword" method="POST">
						<div class="form-group">
							<label for="email">Email</label>
							<input id="email" type="email" class="form-control" name="email" required>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-lg btn-block">Soumettre</button>
						</div>
					</form>
					<p class="text-muted">Si la mémoire vous reviens, vous pouvez <a href="connexion">essayer de vous reconnecter</a>.</p>
				</div>
			</div>
		</div>
	</section>


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePublic.php');
?>