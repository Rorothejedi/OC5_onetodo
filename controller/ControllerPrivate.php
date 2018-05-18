<?php 
namespace App\controller;

/**
 * Class ControllerPrivate
 * Controller qui gère les views et les models de la partie privé du site (tableau de bord, paramètres utilisateurs, création d'un nouveau projet, list des projets ouverts existant et messagerie interne). 
 */
class ControllerPrivate
{

	/**
	 * Vérification de l'existence d'un session de l'utilisateur pour autoriser l'accès à la partie privée.
	 */
	public function __construct()
	{
		if (empty($_SESSION['user_id']) && empty($_SESSION['user_username'])) 
		{ 
			header('Location: ./connexion');
			exit();
		}
	}

	/**
	 *  Méthode d'affichage du tableau de bord (dashboard)
	 */
	public function displayDashboard()
	{
		require('./view/viewPrivate/viewDashboard.php');
	}

	/**
	 * Permet de déconnecter un utilisateur
	 */
	public function disconnect()
	{
		session_destroy();
		setcookie('auth', '', time() - 3600, null, null, false, true);
		header('Location: ./');
		exit();
	}
}