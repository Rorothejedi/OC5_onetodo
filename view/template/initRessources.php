<?php 

	/**
	 * initRessources.php contient les variables à intégrer aux templates. Celui-ci a pour but de centraliser tous les changements potentiels aux niveau des ressources visuels (css, favicon, etc), des CDN ou des appels aux scripts par exemple.
	 */
	
	/*-----------------------------------   Medias and social networks --------------------------------------*/

	$catchword  = "Gérez vos projets en toute simplicité !";
	$urlAdress  = "https://rodolphe.cabotiau.com" . \App\model\App::getDomainPath();
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
	
	$linkCustomScrollbar = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">';

	$linkGoogleFont = '<link href="https://fonts.googleapis.com/css?family=Signika" rel="stylesheet"> ';

	// Development stylesheet and minify version
	$stylesheet       = '<!--<link href="' . \App\model\App::getDomainPath() . '/public/css/stylesheet.css" rel="stylesheet">-->'.
						'<link href="' . \App\model\App::getDomainPath() . '/public/css/stylesheet.min.css" rel="stylesheet">';

	$favicon = '<link rel="icon" type="image/png" href="' . \App\model\App::getDomainPath() . '/public/img/favicon-32x32.png" sizes="32x32">' .
			   '<link rel="icon" type="image/png" href="' . \App\model\App::getDomainPath() . '/public/img/favicon-16x16.png" sizes="16x16">';

	/*---------------------------------------   CDN Calls   ------------------------------------------------*/

	$reCaptcha          = '<script src="https://www.google.com/recaptcha/api.js"></script>';
	$cdnJQuery          = '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>';
	$cdnJQueryUI        = '<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>';
	$jQueryUITouchPunch = '<script src="' . \App\model\App::getDomainPath() . '/public/vendor/jquery.ui.touch-punch.min.js"></script>';
	$cdnPopper          = '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>';
	$cdnBoostrap        = '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>';
	$cdnCustomScrollbar = '<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>';
	$cdnFontAwesomeJs   = '<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>';

	/*------------------------------------   JavaScript files  ------------------------------------------------*/

	$scriptScroll        = '<script src="' . \App\model\App::getDomainPath() . '/public/js/scroll.js"></script>';
	$scriptAlert         = '<script src="' . \App\model\App::getDomainPath() . '/public/js/alert.js" async></script>';
	$scriptInputChecking = '<script src="' . \App\model\App::getDomainPath() . '/public/js/inputChecking.js" async></script>';
	$scriptSidebar		 = '<script src="' . \App\model\App::getDomainPath() . '/public/js/sidebar.js"></script>';
	$scriptConfirm		 = '<script src="' . \App\model\App::getDomainPath() . '/public/js/confirm.js"></script>'; 
	$scriptTooltip       = '<script src="' . \App\model\App::getDomainPath() . '/public/js/tooltip.js"></script>';
	$scriptPopover		 = '<script src="' . \App\model\App::getDomainPath() . '/public/js/popover.js"></script>';
	$scriptTextarea		 = '<script src="' . \App\model\App::getDomainPath() . '/public/js/textarea.js"></script>';
	$scriptTinymce = '<script src="' . \App\model\App::getDomainPath() . '/public/vendor/tinymce/tinymce.min.js"></script>' .
					'<script src="' . \App\model\App::getDomainPath() . '/public/vendor/tinymce/initTinymce.js"></script>';

	$scriptProject = '<script src="' . \App\model\App::getDomainPath() . '/public/js/project.js"></script>';

	/*--------------------------------   JavaScript files : public part  ---------------------------------------------*/

	$scriptPublicLoadingHome = '<script src="' . \App\model\App::getDomainPath() . '/public/js/scriptPublicLoadingHome.js"></script>';

	/*--------------------------------   JavaScript files : private part  ---------------------------------------------*/

	 $scriptPrivateOpenProjects = '<script src="' . \App\model\App::getDomainPath() . '/public/js/scriptPrivateOpenProjects.js"></script>';

	/*--------------------------------   JavaScript files : project part  ---------------------------------------------*/

	$scriptProjectTodolist = '<script src="' . \App\model\App::getDomainPath() . '/public/js/scriptProjectTodolist.js"></script>';
	$scriptProjectWiki     = '<script src="' . \App\model\App::getDomainPath() . '/public/js/scriptProjectWiki.js"></script>';
	$scriptProjectUsers    = '<script src="' . \App\model\App::getDomainPath() . '/public/js/scriptProjectUsers.js"></script>';
	$scriptProjectSettings = '<script src="' . \App\model\App::getDomainPath() . '/public/js/scriptProjectSettings.js"></script>';