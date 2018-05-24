<?php 
	require_once('initRessources.php');
	$avatar = new \App\model\Avatar($userData->email(), 33);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
   	<?php 
   		echo '<title>' . $title . '</title>';
   		echo $meta;
		echo $linkBootstrapCSS; 
		echo $linkGoogleFont;
		echo $linkCustomScrollbar;
		echo $stylesheet;
		echo $favicon;
	?>
</head>

<body>

	<header>
		<nav class="navbar navbar-light navbar_private fixed-top">
  			<div class="container-fluid">
  				<div>
  					<button id="sidebarCollapse" class="hamburger hamburger--slider is-active" type="button">
						<span class="hamburger-box">
						    <span class="hamburger-inner"></span>
						</span>
					</button>
	    			<a class="navbar-brand logoDashboard" href="<?= $absolute_path ?>/dashboard">ONE TO DO</a>
  				</div>
    			<ul class="nav navbar-right">
    				<li class="nav-item" title="Créer un nouveau projet">
    					<a href="#">
    						<i class="fas fa-plus"></i>
    					</a>
    				</li>
    				<li class="nav-item text-center" title="Voir les messages">
    					<a href="<?= $absolute_path ?>/messagerie">
	    					<span class="fa-layers fa-fw">
	    						<i class="fas fa-envelope"></i>
	    						<span class="fa-layers-counter">5</span>
	  						</span>
  						</a>
    				</li>
					<li class="nav-item dropdown">
					  	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Options profil"> 
          					<?= $avatar->generateGravatar() ?>
        				</a>
        				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
				          	<a class="dropdown-item" href="<?= $absolute_path ?>/parametres"><i class="fas fa-cog"></i> Paramètres</a>
				          	<a class="dropdown-item" href="<?= $absolute_path ?>/disconnect"><i class="fas fa-power-off"></i> Déconnexion</a>
				        </div>
        			</li>
    			</ul>
  			</div>
		</nav>
	</header>

	<div class="wrapper">
		<?php 
			require('sidebar.php');
		 ?>

	    <section id="content">
	       <?= $content ?>
	    </section>
	</div>

	<?php
		include('alerts.php');
		// Call to CDN
		echo $cdnJQuery;
		echo $cdnPopper;
		echo $cdnBoostrap;
		echo $cdnCustomScrollbar;
		echo $cdnFontAwesomeJs;

		// Call to JavaScript scripts
		echo $scriptScroll; 
		echo $scriptAlert;
		echo $scriptGlobal;
		echo $scriptSidebar;
		echo $scriptConfirm;
		echo $scriptInputChecking;
	?>

	<script>
		// Script pour pouvoir envoyer un message avec les touches entrées
		$('#userMessage').keydown(function(event) 
		{
		    if (event.keyCode == 13) 
		    {
		        if (!event.shiftKey) 
		        {
		        	$('#formUserMessage').submit();
		        }
		    }
		});
		
		// $('#content_messaging').load('./view/viewPrivate/viewMessagingNotSeen.php');

		// function getAllMessage()
		// {
		// 	$('#content_messaging').fadeOut(function(){
		// 		$('#content_messaging').load('./view/viewPrivate/viewMessagingAll.php', function() {
		// 			$('#content_messaging').fadeIn();
		// 		});
		// 	});
		// }
		// function getNotSeenMessage()
		// {
		// 	$('#content_messaging').fadeOut(function(){
		// 		$('#content_messaging').load('./view/viewPrivate/viewMessagingNotSeen.php', function() {
		// 			$('#content_messaging').fadeIn();
		// 		});
		// 	});
		// }
		
		
	</script>

</body>
</html>