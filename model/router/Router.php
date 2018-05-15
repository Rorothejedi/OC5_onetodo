<?php
namespace App\model\router;

/**
 * Class Router
 * 
 */
class Router {

    private $url; // Contiendra l'URL sur laquelle on souhaite se rendre
    private $routes = []; // Contiendra la liste des routes
    private $namedRoutes = [];

    public function __construct($url){
        $this->url = $url;
    }

    public function get($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'GET');
    }

    public function post($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'POST');
    }

    private function add($path, $callable, $name, $method)
    {
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        if(is_string($callable) && $name === null)
        {
            $name = $callable;
        }
        if($name)
        {
            $this->namedRoutes[$name] = $route;
        }
        return $route;
    }

    public function run()
    {
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']]))
        {
            $this->error404();
        }
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route)
        {
            if($route->match($this->url))
            {
                return $route->call();
            }
        }
       $this->error404();
    }

    public function url($name, $params = [])
    {
        if(!isset($this->namedRoutes[$name]))
        {
            $this->error404();
        }
        return $this->namedRoutes[$name]->getUrl($params);
    }

    private function error404()
	{
		http_response_code(404);
		include('error/404.php');
        die();
	}
}