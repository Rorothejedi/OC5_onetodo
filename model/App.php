<?php
namespace App\model;

/**
 * Class App
 * Permet l'initialisation des constantes primaires de l'application (connexion à la base de données par exemple)
 */
class App
{
	/**
	 * Constante contenant le nom de la base de données.
	 */
	const DB_NAME = 'onetodo';

	/**
	 * Constante contenant le nom d'utilisateur pour effectuer la connexion à la base de données.
	 */
	const DB_USER = 'root';

	/**
	 * Constante contenant le mot de passe pour effectuer la connexion à la base de données.
	 */
	const DB_PASS = '';

	/**
	 * Constante contenant l'hôte de connexion.
	 */
	const DB_HOST = 'localhost';

	/**
	 * Constante contenant le chemin d'accès par défaut du site.
	 */
	const DOMAIN_NAME = '/projet_5_openclassrooms';

	/**
	 * Connexion à la base de données.
	 */
	private static $database;

	/**
	 * Permet d'établir la connexion à la base de données à l'aide de la classe Database.
	 * @return void Connexion à la base de données.
	 */
	public static function getDb()
	{
		if (self::$database === null) 
		{
			self::$database = new Database(self::DB_NAME, self::DB_USER, self::DB_PASS, self::DB_HOST);
		}
		return self::$database;
	}

	/**
	 * Permet d'avoir accès depuis tout le site au chemin absolue.
	 * @return string Chemin d'accès par défaut du site.
	 */
	public static function getDomainPath()
	{
		return self::DOMAIN_NAME;
	}
}