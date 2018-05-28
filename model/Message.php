<?php
namespace App\model;

/**
 * Class Message
 * Définie un objet Message en passant un objet en paramètre lors de l'instanciation.
 */
class Message
{
	private $_id_recipient;
	private $_id_sender;
	private $_content;
	private $_date_reception;
	private $_seen;

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
	public function id_recipient() { 	return $this->_id_recipient; }
	public function id_sender() { 		return $this->_id_sender; }
	public function content() { 		return $this->_content; }
	public function date_reception() { 	return $this->_date_reception; }
	public function seen() { 			return $this->_seen; }

	//Liste des setters
	public function setId_recipient($id_recipient)
	{
		$this->_id_recipient = (int) $id_recipient;
	}

	public function setId_sender($id_sender)
	{
		$this->_id_sender = (int) $id_sender;
	}

	public function setContent($content)
	{
		if(is_string($content))
		{
			$this->_content = $content;
		}
	}

	public function setDate_reception($date_reception)
	{
		if ($date_reception instanceof DateTime)
		{
            $this->_date_reception = $date_reception;
        }
	}

	public function setSeen($seen)
	{
		$seen = (int) $seen;

		if ($seen === 0 || $seen === 1) 
		{
			$this->_seen = $seen;
		}
	}
}