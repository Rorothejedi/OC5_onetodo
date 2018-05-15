<?php
namespace App\model;

/**
 * Class User
 * 
 */
class User
{
	private $_id;
	private $_username;
	private $_email;
	private $_password;
	private $_confirm_register;
	private $_token;

	// Constructeur
	public function __construct($data)
	{
		$this->hydrate($data);
	}

	// Méthode d'hydratation
	public function hydrate($data)
	{
		foreach ($data as $key => $value)
  		{
    	// On récupère le nom du setter correspondant à l'attribut
    	$method = 'set' . ucfirst($key);  

	    	// Si le setter correspondant existe
	    	if (method_exists($this, $method))
	    	{
	      		// On appelle le setter
	      		$this->$method($value);
	    	}
	    }
	}

	//Liste des getters
	public function id() { 				 return $this->_id; }
	public function username() {    	 return $this->_username; }
	public function email() { 			 return $this->_email; }
	public function password() { 		 return $this->_password; }
	public function confirm_register() { return $this->_confirm_register; }
	public function token() { 			 return $this->_token; }

	//Liste des setters
	public function setId($id)
	{
		$this->_id = (int) $id;
	}

	public function setUsername($username)
	{
		if (is_string($username) && strlen($username) >= 2 && strlen($username) <= 25)  
		{
			$this->_username = $username;
		}
	}

	public function setEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$this->_email = $email;
		}
	}

	public function setPassword($password)
	{
		if(preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $password))
		{
			$this->_password = $password;
		}
	}

	public function setConfirm_register($confirm_register)
	{
		if($confirm_register == 0 || $confirm_register == 1)
		{
			$this->_confirm_register = (int) $confirm_register;
		}
	}

	public function setToken($token)
	{
		if(is_string($token))
		{
			$this->_token = $token;
		}
	}
}
