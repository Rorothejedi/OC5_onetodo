<?php 

class RouterAutoloader
{
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload($class)
    {
        require './model/router/' . $class . '.php';
    }
}