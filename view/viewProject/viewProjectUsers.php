<?php 
	$title = 'OneToDo | Utilisateurs du projet';
	ob_start();
	require('projectNavbar.php');
?>

	<div class="container-fluid">
		<h3>Liste des utilisateurs du projet</h3>
	</div>

<?php 
	$content = ob_get_clean();
	require('./view/template/templateProject.php');
?>