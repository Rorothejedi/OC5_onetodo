<?php 
	$title = 'OneToDo | Gérez vos projets en toute simplicité !';
	ob_start();
?>

	

	<div>
		<?php 

			// $datas = App::getDb()->prepare('SELECT * FROM user WHERE username = ?', ['Test'], true);
			
			// echo '<p style="color:white">' . $datas->email . '</p>';
			
		 ?>
	</div>

	</header>

	<section></section>

	


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePublic.php');
?>