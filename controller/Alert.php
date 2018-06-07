<?php

namespace App\controller;

/**
 * Class Alert
 * Permet de générer des alertes utilisateur pour aider celui-ci dans ses démarches.
 */
class Alert
{
	protected function alert_success($message)
	{
		$_SESSION['alert_success'] = $message;
	}
	protected function alert_failure($message, $page)
	{
		$_SESSION['alert_failure'] = $message;
		header('Location: ' . $page);
		exit;
	}
}