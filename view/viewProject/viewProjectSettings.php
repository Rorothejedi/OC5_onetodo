<?php 
	$title = 'OneToDo | Paramètres du projet';
	ob_start();
	require('projectNavbar.php');
?>

	<div class="container-fluid">
		<h3>Paramètres du projet</h3>
	</div>

<?php 
	$content = ob_get_clean();
	require('./view/template/templateProject.php');
?>