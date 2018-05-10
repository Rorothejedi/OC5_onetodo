<?php 

/**
 * Class Autoloader
 * Charge les fichiers correspondant aux différentes class lorsque celle-ci sont appellée
 */
class Autoloader
{
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload($class)
    {
    	if ($class == 'Route' || $class == 'Router')
    	{
        	require './model/router/' . $class . '.php';
    	}
        elseif (preg_match("#controller#i", $class)) 
        {
            require './controller/' . $class . '.php';
        }
    	else
    	{
        	require './model/' . $class . '.php';
    	}
    }
}