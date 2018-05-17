<?php 
namespace App\model;
use PDO;
/**
 * Class Database
 * Permet la connexion à la base de données et l'exécution des requêtes de type query et prepare
 */
class Database
{
	private $db_name;
	private $db_user;
	private $db_pass;
	private $db_host;
	private $pdo;

	/**
	 * Constructeur de la classe Database
	 * @param string $db_name Nom de la base de données
	 * @param string $db_user Nom d'utilisateur de la base de données
	 * @param string $db_pass Mot de passe de la base de données
	 * @param string $db_host Hôte de connexion
	 */
	public function __construct($db_name, $db_user, $db_pass, $db_host)
	{
		$this->db_name = $db_name;
		$this->db_user = $db_user;
		$this->db_pass = $db_pass;
		$this->db_host = $db_host;
	}

	private function getPDO()
	{
		if($this->pdo === null)
		{
			$pdo = new \PDO('mysql:dbname=' . $this->db_name . ';host=' . $this->db_host, $this->db_user, $this->db_pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->query("SET lc_time_names = 'fr_FR'");
			$this->pdo = $pdo;
		}
		return $this->pdo;
	}

	/**
	 * Permet d'effectuer une requête de type query et de renvoyer le résultat sous forme de tableau.
	 * @param  string $request Requête à effectuer dans la base de données.
	 * @return array           Tableau contenant les résultats de la requête.
	 */
	public function query($request, $fetch = false)
	{
		$req = $this->getPDO()->query($request);
		if($fetch)
		{
			$data = $req->fetchAll(PDO::FETCH_OBJ);
			$req->closeCursor(); 
			return $data;
		}
	}

	/**
	 * Permet d'effectuer une requête de type prepare (qui permet de prévenir les failles XSS) et de renvoyer le résultat sous forme de tableau (fetch ou fetchAll).
	 * @param  string  $request    Requête à effectuer dans la base de données.
	 * @param  array   $attributes Attributs correspondants aux conditions de la requête.
	 * @param  boolean $one        Par défaut, celui-ci est défini comme false, une fetchAll va alors être effectué sur le résultat de la requête. Lorsque celui-ci est true, c'est un fetch qui est effectué pour ne retourner que le premier résultat de la requête sous forme de tableau.
	 * @return array               Tableau contenant les résultats de la requête (fetchAll) ou le premier résultat (fetch).
	 */
	public function prepare($request, $attributes, $fetch = false, $one = false, $count = false)
	{
		$req = $this->getPDO()->prepare($request);
		$req->execute($attributes);
		if($fetch)
		{
			if ($count)
			{
				$data = $req->rowCount();
			}
			elseif ($one) 
			{
				$data = $req->fetch(PDO::FETCH_OBJ);
			}
			else
			{
				$data = $req->fetchAll(PDO::FETCH_OBJ);
			}
			$req->closeCursor();
			return $data;
		}
	}
}