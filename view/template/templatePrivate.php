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
    				<li class="nav-item" title="Créer un nouveau projet" data-toggle="tooltip" data-placement="bottom">
    					<a href="<?= $absolute_path ?>/nouveauProjet">
    						<i class="fas fa-plus icon_plus"></i>
    					</a>
    				</li>
    				<li class="nav-item text-center" title="Voir les messages" data-toggle="tooltip" data-placement="bottom">
    					<a href="<?= $absolute_path ?>/messagerie">
	    					<span class="fa-layers fa-fw">
	    						<i class="fas fa-envelope"></i>
	    						<?php 
	    							if ($notSeenMessage > 0)
	    							{
	    								echo '<span class="fa-layers-counter">' . $notSeenMessage . '</span>';
	    							} 
	    						?>	
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
			var attr = $('#userMessage').attr('readonly');

			if (attr === undefined) {
			    if (event.keyCode == 13) 
			    {
			        if (!event.shiftKey) 
			        {
			        	$('#formUserMessage').submit();
			        }
			    }
			}
		});

		// Script de fonctionnement des tooltips.
		$(document).ready(function()
		{
    		$('[data-toggle="tooltip"]').tooltip();   
		});

		// Script qui gère le compteur de caractère de la description de création de projet.
		$(document).ready(function()
		{
			var max = 180;
			$('#descriptionProject').keypress(function(event) 
			{
				if (event.which < 0x20) {
					if ($(this).val().length - 1 == -1) 
					{
						$('.charactersCount').fadeIn('fast').text('Il vous reste 180 caractères');
					} 
					else
					{
						$('.charactersCount').fadeIn('fast').text('Il vous reste ' + (max - ($(this).val().length - 1))  + ' caractères');
					}
					return;
				}

				if ($(this).val().length < max) 
				{
					$('.charactersCount').fadeIn('fast').text('Il vous reste ' + (max - ($(this).val().length + 1)) + ' caractères');
					$('.charactersCountFillIn').addClass('hidden');
				}
				else if ($(this).val().length == max) 
				{
					event.preventDefault();
				}
				else if ($(this).val().length > max)
				{
					$(this).val() = $(this).val().substring(0, max);
				}
			});
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