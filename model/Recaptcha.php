<?php
namespace App\model;

/**
 * Permet l'envoi et la récupération des données permettant de vérifier qu'un utilisateur est bien humain pour éviter tout risque de spam par un robot. 
 */
class Recaptcha
{
	/**
	 * Clé secrète utilisé par Google pour vérifier la validité de la connexion.
	 * @var string
	 */
	private $secret;


	function __construct($secret)
	{
		$this->secret = $secret;
	}

	/**
	 * Soumet l'url contenant la clé secrète ainsi que la réponse de Google.
	 * @param  string $code Contient la valeur du POST avec la réponse de Google sur lavalidité du captcha.
	 * @return bool         Renvoi un booléen sur la validité du captcha.
	 */
	public function checkCode($code)
	{
		if (empty($code)) 
		{
			return false;
		}

		$url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $this->secret . "&response=" . $code;

		if (function_exists('curl_version')) 
		{
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_TIMEOUT, 1);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			$response = curl_exec($curl);
		}
		else
		{
			$response = file_get_contents($url);
		}

		if (empty($response) || is_null($response))
		{
			return false;
		}

		$json = json_decode($response);
		return $json->success;
	}
}
