<?php 
	$title = 'OneToDo | Tableau de bord';
	ob_start();
?>
<br><br>
	<div class="container">
		<h1>Hello OneToDo ! it</h1>
	</div>



<?php 
	$content = ob_get_clean();
	require('./view/template/templatePrivate.php');
?>