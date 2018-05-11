<!-- 

OneTodo - Gérez vos projets en toute simplicité !

Réalisé par Rodolphe Cabotiau
Date de début de projet : 09/05/2018
Date d'achèvement : ../../2018

Dernière mise à jour : 11/05/2018 

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
		echo $linkFontAwesome;
		echo $linkGoogleFont;
		echo $stylesheet;
		echo $favicon;
	?>
</head>

<body>

	<header id="top" class="<?= $header_class ?>">

		<nav class="navbar navbar-light bg-light justify-content-around fixed-top public_navbar">
			<a class="navbar-brand" href="./">
				<img class="logoHome" src="./public/img/logo.png" alt="" height="64px" width="200px" srcset="./public/img/logo.svg">
			</a>
			<div class="btn-group">
				<a href="connexion" class="btn btn-outline-secondary">Se connecter</a>
			    <a href="inscription" class="btn btn-dark">Créer un compte</a>
			</div>
		</nav>

	<?php 
		echo $content;
		include('alerts.php');
	?>

	<footer class="public_footer">
		<div class="footer_element"></div>
		<div class="footer_content">
			<div class="container">
				<div class="d-flex justify-content-between">
					<a href="mentions_legales">Mentions légales</a>
					<a href="https://www.linkedin.com/in/rodolphe-cabotiau-234824132/">Make with <i class="fas fa-heart"></i></a>
					<a href="https://github.com/Rorothejedi/projet_5_openclassrooms">Venez contribuer au projet !</a>
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

		// Call to JavaScript scripts
		echo $scriptScroll;
		echo $scriptAlert;
		echo $scriptInputChecking;
		echo $scriptGlobal;
	?>

</body>
</html>