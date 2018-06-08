<?php 
namespace App\model;

//Import des classes PHPMailer dans le namespace global.
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Permet les envois de mails dans les cas d'inscription et de mot de passe oubliés
 */
class Mail
{
	/**
	 * Contient l'adresse email de l'utilisateur qui doit recevoir le message à transmettre.
	 * @var string
	 */
	private $email;
	
	/**
	 * Contient l'adresse mail d'envoi par défaut du site.
	 * @var string
	 */
	private $from      = 'no-reply@cabotiau.com';
	/**
	 * Contient le mot de passe de l'adresse mail d'envoi par défaut du site.
	 * @var string
	 */
	private $from_pass = '5uF3zdUradUR';

	/**
	 * Contient l'adresse mail de contact du site.
	 * @var string
	 */
	private $from_contact      = 'ecrire@cabotiau.com';
	/**
	 * Contient le mot de passe de l'adresse mail de contact du site.
	 * @var string
	 */
	private $from_contact_pass = 'VbZWgSa7bHc7';

	/**
	 * Contient l'adresse mail du webmaster du site.
	 * @var string
	 */
	private $webmaster_mail = 'rodolphe.cabotiau@gmail.com';

	/**
	 * Transmet les variables passé en argument aux attributs de la classe
	 * @param string $email      Adresse email du destinataire
	 */
	public function __construct($email)
	{
		$this->email = $email;
	}

	/**
	 * Permet l'envoi d'un mail à l'utilisateur pour qu'il puisse activer son compte
	 * @param  string $email 	Nom d'utilisateur
	 * @param  string $key      Token nécessaire pour accéder à la page de validation du compte
	 */
	public function send_register_mail($username, $key)
	{
		$subject = "ONETODO | Confirmation d'inscription";

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
		
		$this->configurationMail($subject, $message, $this->from, $this->from_pass, $this->email);
	}

	/**
	 * Permet l'envoi d'un mail à l'adresse renseigné par l'utilisateur pour que celui-ci puisse réinitialiser son mot de passe.
	 * @param  string $email Nom d'utilisateur
	 * @param  string $key   Token nécessaire pour accéder à la page de réinitialisation de mot de passe
	 */
	public function send_forgot_pass_mail($username, $key)
	{
		$subject = "ONETODO | Réinitialisation du mot de passe";

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
		
		$this->configurationMail($subject, $message, $this->from, $this->from_pass, $this->email);
	}

	/**
	 * Permet l'envoi d'un mail de contact contenant le mail, le sujet et le message d'un utilisateur à transmettre au webmaster.
	 * @param  string $title   Sujet du mail à envoyer.
	 * @param  string $content Contenu du mail à envoyer.
	 */
	public function send_contact_mail($title, $content)
	{
		$subject = "Contact ONETODO | " . $title;

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
	
		$this->configurationMail($subject, $message, $this->from_contact, $this->from_contact_pass, $this->webmaster_mail);
	}

	/**
	 * Permet l'envoi d'un mail à un utilisateur pas encore inscript sur le site et dont le mail a été indiqué par le fondateur d'un projet.
	 * @param  string $username Nom d'utilisateur du fondateur du projet qui souhaite inviter le destinataire du mail.
	 * @param  string $project  Nom du projet dans lequel le destinataire est invité.
	 * @param  int    $access   Accès auquel le fondateur du projet a invité le destinataire du mail (contributeur ou observateur).
	 */
	public function send_user_project_mail($username, $project, $access)
	{
		$subject = 'ONETODO | Invitation au projet "' . $project . '"';

		if ($access == 2) 
		{
			$access = "que contributeur <small>(pour participer activement au projet)</small> !</p>";
		} 
		else
		{
			$access = "qu'observateur <small>(pour consulter les avancées du projet)</small> !</p>";
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
		
		$this->configurationMail($subject, $message, $this->from, $this->from_pass, $this->email);
	}

	/**
	 * Méthode utilisant PHPMailer permettant l'envoi de mail.
	 * @param  string $subject   Sujet du mail à envoyer.
	 * @param  string $message   Message du mail à envoyer.
	 * @param  string $from      Adresse de l'envoyeur du mail.
	 * @param  string $pass      Mot de passe de l'adresse mail de l'envoyeur.
	 * @param  string $recipient Adresse mail du destinataire du mail.
	 */
	private function configurationMail($subject, $message, $from, $pass, $recipient)
	{
	
		//Load Composer's autoloader
		require 'vendor/autoload.php';

		try {
			$mail = new PHPMailer(true);

		    //Server settings
		    // $mail->SMTPDebug = 2;
		    $mail->isSMTP();
			$mail->Host       = 'smtp.phpnet.org';
			$mail->SMTPSecure = 'ssl';
			$mail->SMTPAuth   = true;
			$mail->Port       = 465;

			$mail->SMTPOptions = array(
                'ssl' => array(
					'verify_peer'       => false,
					'verify_peer_name'  => false,
					'allow_self_signed' => true
                )
            );

			$mail->Username   = $from;
			$mail->Password   = $pass;

		    //Recipients
		    $mail->setFrom($from, 'ONETODO');
		    $mail->addAddress($recipient);

		    //Content
		    $mail->CharSet = 'UTF-8';
		    $mail->isHTML(true);
		    $mail->Subject = $subject;
		    $mail->Body    = $message;

		    $mail->Send();
		} 
		catch (Exception $e) 
		{
		    echo 'Le message n\'a pas pu être envoyé. Erreur: ', $mail->ErrorInfo;
		}
	}
}