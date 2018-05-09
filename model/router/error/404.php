<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<title>OneTodo | 404</title>
</head>

<body>
	<h1>Erreur 404 - Vous êtes sur une page qui n'existe plus ou n'a jamais existé.</h1>
	<p>Vous allez être redirigé vers l'accueil dans <span id="timer">7</span> secondes</p>
	
	<!-- Script présent dans la page pour le cas où les ressources ne serait plus disponibles -->
	<script>
		var count   = 7;
		var counter = setInterval(timer, 1000);

		function timer()
		{
		  	count = count - 1;
			if (count <= 0)
			{
			    clearInterval(counter);
				document.location.href = "/projet_5_openclassrooms/";
			 	return;
			}
			document.getElementById("timer").innerHTML = count;
		}
	</script>
</body>
</html>