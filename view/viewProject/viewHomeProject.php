<?php 
	$title = 'OneToDo | Accueil projet';
	ob_start();
?>

	<?php require('projectNavbar.php'); ?>
	<div class="container-fluid">
		<h3>Home !</h3>
	</div>

<?php 
	$content = ob_get_clean();
	require('./view/template/templateProject.php');
?>