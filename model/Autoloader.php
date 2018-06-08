<?php 
namespace App\model;

/**
 * Charge les fichiers correspondant aux différentes class lorsque celle-ci sont appellée de façon automatique
 */
class Autoloader
{

    /**
     * Enregistre l'autoloader
     */
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Inclue le fichier correspondant à la classe transmise en paramètre
     * @param  string $class Nom de la classe à charger
     */
    static function autoload($class)
    {
        $class = str_replace('App\\', '', $class);
        $class = str_replace('\\', '/', $class);
    	if ($class == 'model/router/Route' || $class == 'model/router/Router')
    	{
        	require $class . '.php';
    	}
        elseif (preg_match("#controller#i", $class)) 
        {
            require $class . '.php';
        }
    	else
    	{
        	require $class . '.php';
    	}
    }
}