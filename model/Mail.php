<?php 
namespace App\model;

/**
 * Class Mail
 * Permet les envois de mails dans les cas d'inscription et de mot de passe oubliés
 */
class Mail
{
	private $email;
	private $from         = 'rorotestazerty@gmail.com';
	private $contact_mail = 'rodolphe.cabotiau@gmail.com';

	/**
	 * Transmet les variables passé en argument aux attributs de la classe
	 * @param string $email      Adresse email du destinataire
	 */
	public function __construct($email)
	{
		$this->email = $email;
	}

	//A modifier lors de la mise en ligne (adresse from et lien du mail)
	/**
	 * Permet l'envoi d'un mail à l'utilisateur pour qu'il puisse activer son compte
	 * @param  string $email 	Nom d'utilisateur
	 * @param  string $key      Token nécessaire pour accéder à la page de validation du compte
	 */
	public function send_register_mail($username, $key)
	{
		$subject = "ONETODO | Confirmation d'inscription";

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From: ONETODO ' . $this->from . "\r\n";
		$headers .= 'Reply-To: ' . $this->from . "\r\n";
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
		
		mail($this->email, $subject, $message, $headers);
	}

	/**
	 * Permet l'envoi d'un mail à l'adresse renseigné par l'utilisateur pour que celui-ci puisse réinitialiser son mot de passe.
	 * @param  string $email Nom d'utilisateur
	 * @param  string $key   Token nécessaire pour accéder à la page de réinitialisation de mot de passe
	 */
	public function send_forgot_pass_mail($username, $key)
	{
		$subject = "ONETODO | Réinitialisation du mot de passe";

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From: ONETODO ' . $this->from . "\r\n";
		$headers .= 'Reply-To: ' . $this->from . "\r\n";
		$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();

		$message = "
		<html>
			<head>
				<title>ONETODO | Réinitialisation du mot de passe</title>
			</head>
			<body>
				<p>Cliquez sur le bouton ci-dessous pour accèder à la page vous permettant de réinitialiser votre mot de passe.</p>
				<br>
				<a href='http://localhost/projet_5_openclassrooms/nouveau_mot_de_passe&username=" . urlencode($username) . "&key=". urlencode($key) ."' style='background-color:#306BA2; padding:7px; border-radius:3px; color:white; text-decoration:none'>Réinitialiser mot de passe</a>
				<br><br>
				<small>Cet email est automatique, merci de ne pas y répondre.</small>
			</body>
		</html>
		";
		
		mail($this->email, $subject, $message, $headers);
	}

	
	public function send_contact_mail($title, $content)
	{
		$subject = "Contact ONETODO | " . $title;

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From: Contact ONETODO ' . $this->from . "\r\n";
		$headers .= 'Reply-To: ' . $this->from . "\r\n";
		$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();

		$message = "
		<html>
			<head>
				<title>Contact ONETODO | " . $title . "</title>
			</head>
			<body>
				<h3>Demande de contact de " . $this->email . "</h3>
				<p><em>Sujet :</em> " . $title . "</p>
				<p><em>Message :</em> " . $content . "</p>
				<br>
				<a href='mailto:" . $this->email . "' style='background-color:#306BA2; padding:7px; border-radius:3px; color:white; text-decoration:none'>Répondre</a>
				<br><br>
				<small>Cet email est automatique, merci de ne pas y répondre.</small>
			</body>
		</html>
		";

		mail($this->contact_mail, $subject, $message, $headers);
	}

	// todo :Adresse du lien à modifier lors de la mise en ligne
	public function send_user_project_mail($username, $project, $access)
	{
		$subject = 'ONETODO | Invitation au projet "' . $project . '"';

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From: ONETODO ' . $this->from . "\r\n";
		$headers .= 'Reply-To: ' . $this->from . "\r\n";
		$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();

		if ($access == 2) 
		{
			$access = "que contributeur <small>(participez activement au projet)</small> !</p>";
		} 
		else
		{
			$access = "qu'observateur <small>(consultez les avancées du projet)</small> !</p>";
		}

		$message = '
		<html>
			<head>
				<title>ONETODO | Invitation au projet "<strong>' . $project . '</strong>"</title>
			</head>
			<body>
				<h3>Hello !</h3>
				<br>
				<p><strong>' . $username . '</strong> vous a invité à rejoindre le projet "<strong>' . $project . '</strong>" en tant ' . $access . 
				'<p>Malheureusement, vous n\'êtes pas encore inscrit sur notre plateforme...</p>
				<p><a href="http://localhost/projet_5_openclassrooms/inscription">Inscrivez-vous dès maintenant</a> pour gérer vos projets et contribuer à ceux de vos partenaires.</p>
				<br>
				<p>A très bientôt sur <a href="http://localhost/projet_5_openclassrooms/">ONETODO</a> !</p>
				<br>
				<small>Cet email est automatique, merci de ne pas y répondre.</small>
			</body>
		</html>
		';
		
		mail($this->email, $subject, $message, $headers);
	}
}