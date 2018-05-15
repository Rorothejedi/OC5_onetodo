<?php 
	$title = 'OneToDo | Confirmation de l\'inscription';
	ob_start();
?>

		</header>

		<section class="section_confirm_registration">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-8">
						<h1>Confimez votre inscription</h1>
						<p>
							<br>Votre inscription a bien été prise en compte. <br>
							<br>Un mail viens de vous être envoyé à l'adresse que vous avez renseignée, il est possible que celui-ci soit considéré comme un spam donc vérifiez vos courriers indésirables. <br>
							<br>Confirmez votre inscription à l'aide du lien contenu dans ce mail.
						</p>
					</div>
				</div>
			</div>
		</section>


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePublic.php');
?>