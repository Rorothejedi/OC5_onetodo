<?php 
namespace App\model;

/**
 * Class Avatar
 * Vérifie la présence d'un compte gravatar et génére la balise image avec le lien approprié ou une icône FontAwesome.
 * L'adresse email de l'utilisateur et la taille de l'avatar doivent être passé en argument à l'instanciation de l'objet.
 */
class Avatar
{
	private $email;
	private $size;

	public function __construct($email, $size)
	{
		$this->email = $email;
		$this->size  = $size;
	}

	/**
	 * Permet de vérifier si l'utilisateur possède un compte gravatar avec un avatar associé.
	 * @param  string $email Adresse email de l'utilisateur.
	 * @return bool          Renvoi un booléen en fonction de la présence d'un compte gravatar.
	 */
	private function validateGravatar($email)
	{
		$hash    = md5(strtolower(trim($email)));
		$uri     = 'http://www.gravatar.com/avatar/' . $hash . '?d=404';
		$headers = @get_headers($uri);

		if (!preg_match("|200|", $headers[0])) 
		{
			$has_valid_avatar = false;
		} else 
		{
			$has_valid_avatar = true;
		}
		return $has_valid_avatar;
	}

	/**
	 * Permet de générer le code HTML approprié en fonction de l'existence d'un compte Gravatar.
	 * @param  string $email Adresse email de l'utilisateur.
	 * @param  int    $size  Taille de l'avatar souhaité en pixels.
	 * @return string        Renvoie le code HTML de l'image ou de l'icône.
	 */
	public function generateGravatar()
	{
		$hash = md5(strtolower(trim($this->email)));
		$url  = 'https://gravatar.com/avatar/' . $hash . '?s=' . $this->size;

		if ($this->validateGravatar($this->email))
		{
			if ($this->size === 80) 
			{
				$html = '<a href="https://www.gravatar.com/' . $hash . '" target="_blank">' . 
							'<img src="' . $url . '" alt="" class="rounded-circle">' .
							'<small class="d-block">Modifier l\'avatar</small>' .
						'</a>';
			}
			else
			{
				$html = '<img src="' . $url . '" alt="" class="rounded-circle">';
			}
		}
		else
		{
			if ($this->size === 80) 
			{
				$html = '<a href="https://www.gravatar.com/" target="_blank">' . 
						'<i class="fas fa-user-circle user-circle-settings"></i>' .
						'<small class="d-block">Ajouter un avatar</small>' .
					'</a>';
			}
			else
			{
				$html = '<i class="fas fa-user-circle fa-2x"></i>';
			}
		}
		return $html;
	}
}
