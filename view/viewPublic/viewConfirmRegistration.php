<?php 
	$title = 'OneToDo | Confirmation de l\'inscription';
	ob_start();
?>

		</header>

		<section class="section_confirm_registration">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-8">
						<h1><i class="far fa-envelope" data-fa-transform="shrink-9 up-.5" data-fa-mask="fas fa-comment"></i> Confimez votre inscription pour accéder à votre compte</h1>
						<p>
							<br>Votre inscription a bien été prise en compte. <br>
							<br>Un mail viens de vous être envoyé à l'adresse que vous avez renseignée, il est possible que celui-ci soit considéré comme un spam donc vérifiez vos courriers indésirables. <br>
							<br>Pour valider votre inscription, cliquez sur le bouton dédié présent dans ce mail. <br>
							<br><em>Si vous n'avez pas reçu le mail, entrez vos identifiants <a href="connexion">ici</a>. Un nouveau mail de confirmation vous sera alors automatiquement envoyé.</em>
						</p>
					</div>
				</div>
			</div>
		</section>


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePublic.php');
?>