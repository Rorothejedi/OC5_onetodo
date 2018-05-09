<?php 
	$title = 'OneTodo | Gérez vos projets en toute simplicité !';

	ob_start();
?>

	<header id="top">
		<h1>Hello world</h1>

	</header>

	<section></section>
	<section></section>
	<section></section>


<?php 
	$content = ob_get_clean();

	require('./view/template/templatePublic.php');
?>