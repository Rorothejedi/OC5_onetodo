<?php
namespace App\model;

/**
 * Constitue l'objet Projet tel qu'il est conçu dans le champ "projet" de la base de données.
 */
class Project
{
	private $_id;
	private $_name;
	private $_link;
	private $_status;
	private $_open;
	private $_color;
	private $_description;
	private $_wiki;

	/**
	 * Permet d'hydrater l'objet dès sa construction.
	 * @param object $data Objet contenant certaines informations concernant un projet.
	 */
	public function __construct($data)
	{
		$this->hydrate($data);
	}

	/**
	 * Méthode d'hydratation
	 * @param  objet $data Objet contenant certaines informations concernant un projet.
	 */
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
	public function id() { 			return $this->_id; }
	public function name() { 		return $this->_name; }
	public function link() { 		return $this->_link; }
	public function status() {		return $this->_status; }
	public function open() {		return $this->_open; }
	public function color() {		return $this->_color; }
	public function description() { return $this->_description; }
	public function wiki() { 		return $this->_wiki; }

	// Liste des setters 
	/**
	 * Setter : Vérification de l'id du projet.
	 * @param int $id Identifiant du projet.
	 */
	public function setId($id)
	{
		$this->_id = (int) $id;
	}

	/**
	 * Setter : Vérification du nom du projet.
	 * @param string $name Nom du projet.
	 */
	public function setName($name)
	{
		if (is_string($name) && strlen($name) <= 35)
		{
			$this->_name = $name;
		}
	}

	/**
	 * Setter : Vérification du lien du projet.
	 * @param string $link Lien du projet.
	 */
	public function setLink($link)
	{
		if (is_string($link))
		{
			$this->_link = $link;
		}
	}

	/**
	 * Setter : Vérification du status du projet (ouvert ou fermé).
	 * @param int $status Status du projet.
	 */
	public function setStatus($status)
	{
		if ($status == 0 || $status == 1) 
		{
			$this->_status = $status;
		}
	}

	/**
	 * Setter : Vérification du niveau d'ouverture du projet.
	 * @param int $open Niveau d'ouverture du projet.
	 */
	public function setOpen($open)
	{
		if ($open == null || $open == 0 || $open == 1) 
		{
			$this->_open = $open;
		}
	}

	/**
	 * Setter : Vérification que la couleur ajouté est bien en héxadécimal (#09AAFF)
	 * @param string $color Code hexadécimal de la couleur du projet.
	 */
	public function setColor($color)
	{
		if (preg_match('/#([a-f0-9]{3}){1,2}\b/i', $color)) 
		{
			$this->_color = $color;
		}
	}

	/**
	 * Setter : Vérification de la description du projet.
	 * @param string $description Description du projet.
	 */
	public function setDescription($description)
	{
		if (is_string($description) && strlen($description) <= 180) 
		{
			$this->_description = $description;
		}
	}

	/**
	 * Setter : Vérification du wiki du projet.
	 * @param string $wiki Wiki du projet.
	 */
	public function setWiki($wiki)
	{
		if (is_string($wiki)) 
		{
			$this->_wiki = $wiki;
		}
	}
}