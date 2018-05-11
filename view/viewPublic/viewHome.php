<?php 
	$title = 'OneToDo | Gérez vos projets en toute simplicité !';
	$header_class = 'topHome';
	ob_start();
?>

	

	<div>
		<?php 

			// $datas = App::getDb()->prepare('SELECT * FROM user WHERE username = ?', ['Test'], true);
			
			// echo '<p style="color:white">' . $datas->email . '</p>';
			
		 ?>
	</div>

	</header>

	<section>
		<p><a href="dashboard">Tableau de bord</a></p>
	</section>

	


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePublic.php');
?>