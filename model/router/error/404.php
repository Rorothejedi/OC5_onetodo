<?php 
	require_once('./view/template/initRessources.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<?php 
		echo $meta;
		echo $linkBootstrapCSS; 
		echo $stylesheet;
	?>
	<title>OneTodo | 404</title>
	<style>
		body {
			background-color: var(--user-color) !important;
			color: var(--third-color) !important;
		}
		.container{
			height: 100vh;
		}
		a {
			font-size: 1.3rem;
			color: var(--third-color) !important;
		}
	</style>
</head>

<body>
	<div class="container d-flex align-items-center justify-content-center">
		<div>
			<div>
				<a href="<?= \App\model\App::getDomainPath(); ?>">
					<h1 class="logoHome text-center">ONETODO</h1>
				</a>
			</div>
			<br>
			<hr>
			<br>
			<div>
				<h3><em>Erreur 404</em></h3>
			</div>
			<br>
			<div>
				<h4>Vous êtes sur une page qui n'existe plus ou n'a jamais existé !</h4>
			</div>
			<br>
			<div>
				<p>Vous allez être redirigé vers la page précédente dans <span id="timer">8</span> secondes</p>	
			</div>
		</div>
	</div>

	<!-- Script présent dans la page pour le cas où les ressources ne serait plus disponibles -->
	<script>
		var count   = 8;
		var counter = setInterval(timer, 1000);

		function timer()
		{
		  	count = count - 1;
			if (count <= 0)
			{
			    clearInterval(counter);
			    <?php 
			    	if (isset($_SESSION['user_id'])) 
			    	{
			    		echo 'document.location.href = "' . \App\model\App::getDomainPath() . '/dashboard";';
			    	}
			    	else
			    	{
			    		echo 'document.location.href = "' . \App\model\App::getDomainPath() . '";';
			    	}
			    ?>
			 	return;
			}
			document.getElementById("timer").innerHTML = count;
		}
	</script>
	
	<?php 
		echo $cdnBoostrap;
	 ?>
</body>
</html>