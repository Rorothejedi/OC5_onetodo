<?php 

/**
 * Class ControllerPublic
 * Controller qui gère les views et les models de la partie public du site (page d'accueil, de connexion, d'inscription et les mentions légales) 
 */
class ControllerPublic
{
	public function displayHome()
	{
		require('./view/viewPublic/viewHome.php');
	}

	public function displayLegal()
	{
		require('./view/viewPublic/viewLegal.php');
	}

	public function displayConnection()
	{
		require('./view/viewPublic/viewConnection.php');
	}

	public function displayRegistration()
	{
		require('./view/viewPublic/viewRegistration.php');
	}
}