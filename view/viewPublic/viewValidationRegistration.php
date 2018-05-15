<?php 
	$title = 'OneToDo | Validation de l\'inscription';
	ob_start();
?>

		</header>

		<section class="section_confirm_registration">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-8">
						<h1>C'est parti !</h1>
						<p>
							<br>Votre compte est bien validé !
							<br>Créez dès maintenant votre projet et invitez y vos collaborateurs. 
							<br>Ou bien rejoignez les projets d'autres pour multiplier leur potentiel !
						</p>
						<a href="connexion" class="btn btn-primary">Connectez-vous dès maintenant!</a>
					</div>
				</div>
			</div>
		</section>


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePublic.php');
?>