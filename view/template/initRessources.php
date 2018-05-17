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

	$linkBootstrapCSS    = '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">';
	
	//Font Awesome : Version 5.0.13 (Remplacé par le script JS qui charge les icônes en SVG (voir $cdnFontAwesomeJs))
	// $linkFontAwesome     = '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">';
	
	$linkCustomScrollbar = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">';

	//A définir !
	$linkGoogleFont   = '';

	// Development stylesheet and minify version
	$stylesheet       = '<link href="./public/css/stylesheet.css" rel="stylesheet">'.
						'<!-- <link href="./public/css/stylesheet.min.css" rel="stylesheet"> -->'.
						'<link rel="stylesheet" href="./public/css/hamburger.css">';

	$favicon          = '<!-- <link rel="shortcut icon" type="image/x-icon" href="./public/img/favicon.ico">  -->'.
						'<!-- <link rel="icon" type="image/x-icon" href="./public/img/favicon.ico"> -->';

	/*---------------------------------------   CDN Calls   ------------------------------------------------*/

	$cdnJQuery          = '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>';
	$cdnPopper          = '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>';
	$cdnBoostrap        = '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>';
	$cdnCustomScrollbar = '<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>';
	$cdnFontAwesomeJs   = '<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>';

	/*------------------------------------   Javascript files  ------------------------------------------------*/

	$scriptScroll        = '<script src="./public/js/scroll.js"></script>';
	$scriptAlert         = '<script src="./public/js/alert.js"></script>';
	$scriptInputChecking = '<script src="./public/js/inputChecking.js"></script>';
	$scriptGlobal        = '<script src="./public/js/global.js"></script>';
	$scriptSidebar		 = '<script src="./public/js/sidebar.js"></script>';
