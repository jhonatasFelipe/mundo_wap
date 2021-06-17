<?php

namespace motor;


use src\Controllers\ProdutoController;
use src\Singleton\ContainerSingleton;

class Router
{
    public $routes = [];
    public $actualUri ;

    public function __construct()
    {
       $this->actualUri = $_SERVER['REQUEST_URI'];
    }


    public function add(Route $route){
        $this->routes[] = $route;
    }

    public function addRoutesAsArray(Array $routes){
        foreach ($routes as $route ){
            $this->routes[] = $route;
        }
    }

    public function getRoutes(){
        return $this->routes;
    }

    public function routeMatchVerify():array{
       return  Array_filter($this->routes, function ($route,$key){
            return $this->actualUri == $route->path;
        },ARRAY_FILTER_USE_BOTH);
    }

    public function dispatch(){
       $container =  ContainerSingleton::getInstance();
        if(count($this->routeMatchVerify()) > 0){
            $routematch = $this->routeMatchVerify();
            $route = array_shift($routematch);
            $controller  = $container->get($route->controller) ;
            $action = $route->action;
            $controller->$action();

        }
    }

    public function navegate(string $path){
        $this->actualUri = $path;
        $this->dispatch();
    }
}