<?php
namespace App\controller;

/**
 * Permet de générer des alertes utilisateur pour aider celui-ci dans ses démarches.
 */
class Alert
{
	/**
	 * Génére une alerte de succès (verte) à l'utilisateur.
	 * @param  string $message Message de succès à afficher à l'utilisateur.
	 */
	protected function alert_success($message)
	{
		$_SESSION['alert_success'] = $message;
	}

	/**
	 * Génére une alerte d'erreur (rouge) à l'utilisateur.
	 * @param  string $message Message d'erreur à afficher à l'utilisateur.
	 * @param  string $page    Page vers laquelle doit être redirigée l'utilisateur pour que l'erreur s'affiche.
	 */
	protected function alert_failure($message, $page)
	{
		$_SESSION['alert_failure'] = $message;
		header('Location: ' . $page);
		exit;
	}
}