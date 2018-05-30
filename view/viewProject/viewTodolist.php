<?php 
	$title = 'OneToDo | Liste(s) des tâches';
	ob_start();
	require('projectNavbar.php');
?>

	<div class="container-fluid">
		<h3>Todolist !</h3>
	</div>

<?php 
	$content = ob_get_clean();
	require('./view/template/templateProject.php');
?>