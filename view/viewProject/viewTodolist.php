<?php 
	$title = 'OneToDo | Liste(s) des tâches';
	ob_start();
?>

	<div class="container-fluid">
		<?php require('projectNavbar.php'); ?>
		<h3>Todolist !</h3>
	</div>

<?php 
	$content = ob_get_clean();
	require('./view/template/templateProject.php');
?>