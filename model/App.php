<?php
namespace App\model;

/**
 * Class App
 * Permet l'initialisation des constantes primaires de l'application (connexion à la base de données par exemple)
 */
class App
{
	const DB_NAME = 'onetodo';
	const DB_USER = 'root';
	const DB_PASS = '';
	const DB_HOST = 'localhost';
	const DOMAIN_NAME = '/projet_5_openclassrooms';

	private static $database;

	public static function getDb()
	{
		if (self::$database === null) 
		{
			self::$database = new Database(self::DB_NAME, self::DB_USER, self::DB_PASS, self::DB_HOST);
		}
		return self::$database;
	}

	public static function getDomainPath()
	{
		return self::DOMAIN_NAME;
	}
}