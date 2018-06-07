<?php 
	$title = 'OneToDo | Gérez vos projets en toute simplicité !';
	$header_class = 'topHome';
	ob_start();
?>
		<div class="loading_home d-flex justify-content-center align-items-center">
			<i class="fas fa-circle-notch fa-spin fa-3x"></i>
		</div>
		<div class="background_header">
			<div class="container d-flex align-items-center">
				<div class="row">
					<div class="topHomeText col-12">
						<h2>Gérez <em>facilement</em> et <em>gratuitement</em> <br>
							vos projets solo ou en équipe <br>
							avec un maximum d'efficacité !
						</h2>
						<br>
						<div class="mb-2">
							<a href="inscription" class="d-flex align-items-center">
								<i class="fas fa-check-square fa-2x mr-3"></i> 
								<div class="btn btn-dark button-public-home">Inscrivez-vous</div>
							</a>
						</div>
						<div>
							<a href="connexion" class="d-flex align-items-center">
								<i class="fas fa-square fa-2x mr-3"></i>
								<div class="btn btn-dark button-public-home">Connectez-vous</div>
							</a>
						</div>
						<hr>
						<div class="d-flex align-items-center">
							<i class="fas fa-check-square fa-2x mr-3"></i> 
							<h4>Rejoignez-nous !</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<section id="sectionPresentation">
		<h2 hidden>Présentation</h2>
		<div class="container d-flex align-items-center justify-content-center">
			<div class="row col-12 d-flex justify-content-around">
				<a href="inscription" class="col-lg-4 col-md-6 text-center link-public-home">
					<i class="fas fa-users fa-3x icon-public-home"></i>
					<p class="mt-4">Créez votre projet <br>et rassemblez votre équipe</p>	
				</a>
				<a href="#sectionStatus" class="col-lg-4 col-md-6 text-center link-public-home">
					<i class="fas fa-key fa-3x icon-public-home"></i>
					<p class="mt-4">Décidez du status de votre projet</p>	
				</a>
				<a href="#sectionRole" class="col-lg-4 col-md-6 text-center link-public-home">
					<i class="fas fa-crown fa-3x icon-public-home"></i>
					<p class="mt-4">Choisissez votre rôle <br>ou celui des membres de votre équipe</p>	
				</a>
			</div>
		</div>
	</section>

	<section id="sectionStatus">
		<div class="container">
			<div class="text-center pt-5">
				<h4 class="pt-5 pb-3">Créez autant de projet que vous le souhaitez !</h4>
				<h6>Chacun d'eux peut être privé ou ouvert à la créativité de la communauté.</h6>
			</div>
			<div class="row mt-5 pt-5 pb-5">
				<div class="col-lg-2 col-md-12 text-center">
					<p><em>Projet privé</em></p>
					<i class="fas fa-lock fa-2x"></i>
				</div>
				<div class="col-lg-10 col-md-12 d-flex align-items-center">
					<p>Vous avez un contrôle total sur les utilisateurs qui rejoignent votre projet et sur leurs droits d'accès.</p>
				</div>	
			</div>
			<div class="row mt-5 pb-5">
				<div class="col-lg-2 text-center">
					<p><em>Projet ouvert</em></p>
					<i class="fas fa-lock-open fa-2x"></i>
				</div>
				<div class="col-lg-10 d-flex align-items-center">
					<p>Vous laissez la possibilité aux autres utilisateurs de la plateforme de se joindre à votre projet. Dans ce cas, vous devez choisir si vous leur laissez la possibilité de le modifier <em>(contributeur)</em> ou si vous leur laissez la simple possibilité de jeter un coup d'oeil <em>(observateur)</em>.</p>
				</div>
			</div>
			<br><br>
		</div>
	</section>

	<section id="sectionRole">
		<div class="container">
			<div class="text-center pt-5">
				<h4 class="pt-5 pb-3">Occupez des rôles différents au sein de chaque projet !</h4>
				<h6>Vous pouvez être ...</h6>
			</div>
			<div class="row mt-5 pt-5 pb-5">
				<div class="col-lg-2 col-md-12 text-center">
					<p><em>... Fondateur</em></p>
					<i class="fas fa-crown fa-2x"></i>
				</div>
				<div class="col-lg-10 col-md-12 d-flex align-items-center">
					<p>C'est simple, il s'agit du créateur du projet. Il a un contrôle total sur tout les aspects du projet qu'il a conçu. C'est le seul à pouvoir paramétrer le projet.</p>
				</div>	
			</div>
			<div class="row mt-5 pb-5">
				<div class="col-lg-2 text-center">
					<p><em>... Contributeur</em></p>
					<i class="fas fa-pencil-alt fa-2x"></i>
				</div>
				<div class="col-lg-10 d-flex align-items-center">
					<p>Il est essentiel. Celui-ci va apporter son expertise sur tous les aspects du projet qui ne relèvent pas de son administration.</p>
				</div>
			</div>
			<div class="row mt-5 pb-5">
				<div class="col-lg-2 text-center">
					<p><em>... Observateur</em></p>
					<i class="fas fa-eye fa-2x"></i>
				</div>
				<div class="col-lg-10 d-flex align-items-center">
					<p>Comme son nom l'indique, celui-ci... observe ! Il va pouvoir vérifier que le projet avance comme convenu ou simplement jeter un oeil par curiosité. A l'inverse des autres rôles, celui-ci n'a pas de rôle actif au sein du projet.</p>
				</div>
			</div>
			<br><br><br>
		</div>
	</section>

	<section id="sectionWebmaster">
		<div class="container">
			<div class="text-center pt-5 mt-5">
				<h4 class="pt-5 pb-3">Qui est derrière <em>ONETODO</em> ?</h4>
			</div>
			<p class="mt-5 mb-5"><em>ONETODO</em> est une plateforme de gestion de projet réalisée par un étudiant dans le cadre d'un projet de fin de formation. <br><br> La plateforme oscille pour l'instant entre prototype et version alpha. Par conséquent, de futures fonctionnalités sont à l'étude en attendant leurs éventuels ajouts ultérieurs. <br><br>Si vous avez des idées pour améliorer la plateforme, n'hésitez pas à nous <a href="contact">en faire part</a> ! <br>De même, tous les développeurs intéressés par ce projet sont les bienvenus pour <a href="https://github.com/Rorothejedi/projet_5_openclassrooms" target="_blank">apporter leur pierre à l'édifice</a> !<br></p>
		</div><br><br>
	</section>


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePublic.php');
?>