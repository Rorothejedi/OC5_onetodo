<!-- 

OneTodo - Gérez vos projets en toute simplicité !

Réalisé par Rodolphe Cabotiau
Date de début de projet : 09/05/2018
Date d'achèvement V1.0: ../06/2018

Dernière mise à jour : 04/06/2018 

-->

<?php 
	require_once('initRessources.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<title><?= $title ?></title>
	<?= $meta ?>

  	<!-- Tags Open Graph -->
	<meta property="og:title" content="<?= $title ?>">
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?= $urlAdress ?>">
	<meta property="og:image" content="<?= $urlAdress ?>img/imgOpenGraph.jpg">
	<meta property="og:description" content="<?= $catchword ?>"/>
	<meta property="og:locale" content="fr_FR" />

	<!-- Tags Twitter Card -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="<?= $twitterTag ?>">
	<meta name="twitter:title" content="<?= $title ?>">
	<meta name="twitter:description" content="<?= $catchword ?>">
	<meta name="twitter:creator" content="<?= $twitterTag ?>">
	<meta name="twitter:image" content="<?= $urlAdress ?>img/imgTwitterCard.jpg">

	<!-- Tags Google -->
	<meta name="description" content="<?= $title ?>">
	<meta name="keywords" content="<?= $keywords ?>">

	<!-- CSS Bootstrap / Icons FontAwesome / Google Fonts / Stylesheets / Favicon -->
	<?php 
		echo $linkBootstrapCSS; 
		echo $linkGoogleFont;
		echo $stylesheet;
		echo $favicon;
	?>

<!-- FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Signika" rel="stylesheet"> 



	<!-- Intégration ReCaptcha V2 -->
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>

	<header id="top" class="<?php if(isset($header_class)){echo $header_class;} ?>">
		<nav class="navbar navbar-light bg-light justify-content-around fixed-top public_navbar">
			<div class="d-flex">
				<a class="navbar-brand logoHome" href="./">ONE TO DO</a>
				<p class="small"><em>Alpha 1.0</em></p>
			</div>
			
			<div class="btn-group">
				<?php 

					if (!empty($_SESSION['user_id']) && !empty($_SESSION['user_username'])) 
					{
						echo '<a href="dashboard" class="btn btn-dark btn_small">Accéder au tableau de bord | <strong>' . $_SESSION['user_username'] . '</strong></a>';
					}
					else
					{
						echo '<a href="connexion" class="btn btn-outline-secondary btn_small">Se connecter</a>' .
							 '<a href="inscription" class="btn btn-dark btn_small">Créer un compte</a>';
					}
				?>	    
			</div>		
		</nav>
		<!-- <div class="line d-flex"></div> -->

	<?php 
		include('alerts.php');
		echo $content;
	?>

	<footer class="public_footer">
		<div class="footer_element"></div>
		<div class="footer_content">
			<div class="container">
				<div class="d-flex align-items-end">
					<a class="text-left" href="https://github.com/Rorothejedi/projet_5_openclassrooms">Venez contribuer au projet !</a>
					<a class="text-center" href="contact">Contact</a>
					<a class="text-right" href="mentions_legales">Mentions légales</a>
				</div>
				<div class="d-flex align-items-center">
					<a class="text-center" href="https://www.linkedin.com/in/rodolphe-cabotiau-234824132/">Made with <i class="fas fa-heart fa-xs"></i></a>
				</div>
			</div>
		</div>
	</footer>

	<!-- Scroll to top button -->
	<a href="#top" class="top d-none d-md-block">
		<i class="fas fa-arrow-circle-up fa-3x hidden"></i>
	</a>

	<?php 
		// Call to CDN
		echo $cdnJQuery;
		echo $cdnPopper;
		echo $cdnBoostrap;
		echo $cdnFontAwesomeJs;

		// Call to JavaScript scripts
		echo $scriptScroll;
		echo $scriptAlert;
		echo $scriptInputChecking;
		echo $scriptGlobal;
	?>

</body>
</html>