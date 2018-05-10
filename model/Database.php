<?php 

/**
 * Class Database
 * Permet la connexion à la base de données
 */
class Database
{
	private $db_name;
	private $db_user;
	private $db_pass;
	private $db_host;
	private $pdo;

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
			$pdo = new PDO('mysql:dbname=onetodo;host=localhost', 'root', '');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->query("SET lc_time_names = 'fr_FR'");
			$this->pdo = $pdo;
		}
		return $pdo;
	}

	public function query($request)
	{
		$req = $this->getPDO()->query($request);
		$datas = $req->fetchAll(PDO::FETCH_OBJ);
		return $datas;
	}

	public function prepare($request, $attributes, $one = false)
	{
		$req = $this->getPDO()->prepare($request);
		$req->execute($attributes);
		if ($one) 
		{
			$datas = $req->fetch(PDO::FETCH_OBJ);
		}
		else
		{
			$datas = $req->fetchAll(PDO::FETCH_OBJ);
		}
		return $datas;
	}

}