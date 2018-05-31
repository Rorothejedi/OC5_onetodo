<?php 
	require_once('initRessources.php');
	$avatar      = new \App\model\Avatar($userData->email(), 33);
	$projectLink = explode("/", $_GET['url']);
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

	<?php require('navbar.php'); ?>

	<div class="wrapper">
		<?php require('sidebar.php'); ?>
	    <section id="content" class="project">
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
		echo $scriptTooltip;
		echo $scriptTextarea;
		echo $scriptProjectDescription;
	?>

	<script>
		
		$('.button-edit-project-disabled').click(function() {
			$('#descriptionProject, #colorProject, #statusProject, #nameProject').removeAttr('disabled');
			$('.button-edit-project').show();
			$(this).hide();
		});

	</script>

</body>
</html>