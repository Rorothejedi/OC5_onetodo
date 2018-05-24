<?php
namespace App\model;

/**
 * Class Project
 * 
 */
class Project
{
	private $_id;
	private $_name;
	private $_status;
	private $_color;
	private $_description;
	private $_wiki;

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
	public function id() { return $this->_id; }
	public function name() { return $this->_name; }
	public function status() { return $this->_status; }
	public function color() { return $this->_color; }
	public function description() { return $this->_description; }
	public function wiki() { return $this->_wiki; }

	// Liste des setters
	public function setId($id)
	{
		$this->_id = (int) $id;
	}

	public function setName($name)
	{
		if (is_string($name))  
		{
			$this->_name = $name;
		}
	}

	public function setStatus($status)
	{
		if ($status === 0 || $status === 1) 
		{
			$this->_status = $status;
		}
	}

	/**
	 * Vérification que la couleur ajouté est bien en héxadécimal (#09AAFF)
	 */
	public function setColor($color)
	{
		if (preg_match('/#([a-f0-9]{3}){1,2}\b/i', $color)) 
		{
			$this->_color = $color;
		}
	}

	public function setDescription($description)
	{
		if (is_string($description)) 
		{
			$this->_description = $description;
		}
	}

	public function setWiki($wiki)
	{
		if (is_string($wiki)) 
		{
			$this->_wiki = $wiki;
		}
	}
}