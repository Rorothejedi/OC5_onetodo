<!-- 

OneTodo - Gérez vos projets en toute simplicité !

Réalisé par Rodolphe Cabotiau
Date de début de projet : 09/05/2018
Date d'achèvement : ../../2018

Dernière mise à jour : 09/05/2018 

-->

<?php 
	$catchword  = "Gérez vos projets en toute simplicité !";
	$urlAdress  = "https://rodolphe.cabotiau.com/projet_5_openclassrooms/";
	$keywords   = "gestion projets";
	$twitterTag = "@RCabotiau";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<title><?= $title ?></title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js%22%3E</script>
    	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js%22%3E</script>
    <![endif]-->

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

	<!-- CSS Bootstrap / Icons FontAwesome / Google Fonts-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
	<!-- <link href="https://fonts.googleapis.com/css?family=Gaegu%7CRaleway:400,400i,700" rel="stylesheet"> -->

	<!-- Main CSS Sheet / Minify CSS -->
	<link href="./public/css/stylesheet.css" rel="stylesheet">
	<link href="./public/css/stylesheet.min.css" rel="stylesheet">

	<!-- Favicon -->
	<!-- <link rel="shortcut icon" type="image/x-icon" href="./public/img/favicon.ico">  -->
	<!-- <link rel="icon" type="image/x-icon" href="./public/img/favicon.ico"> -->
</head>

<body>

	<?php 
		echo $content;
		include('alerts.php');
	?>
	<!-- Scroll to top button -->
	<a href="#top" class="top d-none d-md-block">
		<i class="fas fa-arrow-circle-up fa-3x hidden"></i>
	</a>

	<!-- Call to CDN -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

	<!-- Call to JavaScript scripts -->
	<script src="./public/js/scroll.js"></script>
	<script src="./public/js/alert.js"></script>
	<script src="./public/js/inputChecking.js"></script>
	<script src="./public/js/global.js"></script>
	
</body>
</html>