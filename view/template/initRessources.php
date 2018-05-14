<?php 

	/**
	 * initRessources.php contient les varibales à intégrer aux templates. Celui-ci a pour but de centraliser tous les changements potentiels aux niveau des ressources visuels (css, favicon, etc), des CDN ou des appels aux scripts par exemple.
	 */
	
	/*-----------------------------------   Medias and social networks --------------------------------------*/

	$catchword  = "Gérez vos projets en toute simplicité !";
	$urlAdress  = "https://rodolphe.cabotiau.com/projet_5_openclassrooms/";
	$keywords   = "gestion projets";
	$twitterTag = "@RCabotiau";

	/*----------------------------------------   Common meta  ------------------------------------------------*/

	$meta = '<meta charset="UTF-8">'.
			'<meta http-equiv="X-UA-Compatible" content="IE=edge">'.
			'<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">'.
			'<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->'.
    		'<!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->'.
		    '<!--[if lt IE 9]>
		    	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js%22%3E</script>
		    	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js%22%3E</script>
		    <![endif]-->';

	/*------------------------------------------   Head link   -------------------------------------------------*/

	$linkBootstrapCSS = '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">';
	
	$linkFontAwesome  = '<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>';

	//A définir !
	$linkGoogleFont   = '';

	// Development stylesheet and minify version
	$stylesheet       = '<link href="./public/css/stylesheet.css" rel="stylesheet">'.
						'<!-- <link href="./public/css/stylesheet.min.css" rel="stylesheet"> -->';

	$favicon          = '<!-- <link rel="shortcut icon" type="image/x-icon" href="./public/img/favicon.ico">  -->'.
						'<!-- <link rel="icon" type="image/x-icon" href="./public/img/favicon.ico"> -->';

	/*---------------------------------------   CDN Calls   ------------------------------------------------*/

	$cdnJQuery   = '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>';
	$cdnPopper   = '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>';
	$cdnBoostrap = '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>';

	/*------------------------------------   Javascript files  ------------------------------------------------*/

	$scriptScroll        = '<script src="./public/js/scroll.js"></script>';
	$scriptAlert         = '<script src="./public/js/alert.js"></script>';
	$scriptInputChecking = '<script src="./public/js/inputChecking.js"></script>';
	$scriptGlobal        = '<script src="./public/js/global.js"></script>';
