<?php 
namespace App\model;

/**
 * Class Mail
 * Permet les envois de mails dans les cas d'inscription et de mot de passe oubliés
 */
class Mail
{
	private $to;

	/**
	 * Transmet les variables passé en argument aux attributs de la classe
	 * @param string $to      Adresse email du destinataire
	 */
	public function __construct($to)
	{
		$this->to = $to;
	}

	//A modifier lors de la mise en ligne (adresse from et lien du mail)
	public function send_register_mail($username, $key)
	{
		$from    = 'rorotestazerty@gmail.com';
		$subject = "ONETODO | Confirmation d'inscription";

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From: ONETODO ' . $from . "\r\n";
		$headers .= 'Reply-To: ' . $from . "\r\n";
		$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();

		$message = "
		<html>
			<head>
				<title>ONETODO | Demande de confirmation d'inscription</title>
			</head>
			<body>
				<h2>Bienvenue sur ONETODO !</h2>
				<p>Merci de nous rejoindre, mais avant cela il vous reste une ultime étape !<br> Pour accèder à votre espace et commencer à profiter de nos services, merci de confirmer votre inscription.</p>
				<br>
				<a href='http://localhost/projet_5_openclassrooms/validation_inscription&username=" . urlencode($username) . "&key=". urlencode($key) ."' style='background-color:#306BA2; padding:7px; border-radius:3px; color:white; text-decoration:none'>Confirmer l'inscription</a>
				<br><br>
				<small>Cet email est automatique, merci de ne pas y répondre.</small>
			</body>
		</html>
		";
		
		mail($this->to, $subject, $message, $headers);
	}
}