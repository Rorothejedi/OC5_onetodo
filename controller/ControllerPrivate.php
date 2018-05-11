<?php 

/**
 * Class ControllerPrivate
 * Controller qui gère les views et les models de la partie privé du site (tableau de bord, paramètres utilisateurs, création d'un nouveau projet, list des projets ouverts existant et messagerie interne). 
 */
class ControllerPrivate
{
	public function displayDashboard()
	{
		require('./view/viewPrivate/viewDashboard.php');
	}
}