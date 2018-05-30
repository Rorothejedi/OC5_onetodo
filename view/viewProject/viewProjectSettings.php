<?php 
	$title = 'OneToDo | Paramètres du projet';
	ob_start();
?>

	<div class="container-fluid">
		<?php require('projectNavbar.php'); ?>
		<h3>Paramètres du projet</h3>
	</div>

<?php 
	$content = ob_get_clean();
	require('./view/template/templateProject.php');
?>