<?php 
	$title = 'OneToDo | Wiki projet';
	ob_start();
	require('projectNavbar.php');
?>

	<div class="container-fluid">
		<h3>Wiki</h3>
	</div>

<?php 
	$content = ob_get_clean();
	require('./view/template/templateProject.php');
?>