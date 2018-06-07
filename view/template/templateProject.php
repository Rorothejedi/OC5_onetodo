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
		echo $scriptTinymce;
		echo $linkGoogleFont;
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
		echo $cdnJQueryUI;
		echo $jQueryUITouchPunch;
	?>
		<!-- Resolve le conflit entre les tooltips bootstrap et jquery UI -->
		<script>$.widget.bridge('uitooltip', $.ui.tooltip);</script>
	<?php
		echo $cdnPopper;
		echo $cdnBoostrap;
		echo $cdnCustomScrollbar;
		echo $cdnFontAwesomeJs;

		// Call to JavaScript scripts
		echo $scriptAlert;
		echo $scriptSidebar;
		echo $scriptConfirm;
		echo $scriptInputChecking;
		echo $scriptTooltip;
		echo $scriptTextarea;

		echo $scriptProject;
		echo $scriptProjectTodolist;
		echo $scriptProjectWiki;
		echo $scriptProjectUsers;
		echo $scriptProjectSettings;
	?>
</body>
</html>