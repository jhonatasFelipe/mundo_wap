<?php

namespace motor;


use src\Controllers\ProdutoController;
use src\Singleton\ContainerSingleton;

class Router
{
    public $routes = [];
    public $actualUri ;
    public $params;

    public function __construct()
    {
        $rotaseparada =  explode("/", $_SERVER['REQUEST_URI']);
        if(count($rotaseparada) > 2){
            $this->params = array_pop($rotaseparada);
            foreach ($rotaseparada as $seguimento){
                if(!$seguimento =="") {
                    $this->actualUri = $this->actualUri . "/" . $seguimento;
                }
            }
        }
        else{
            $this->actualUri = "/".$rotaseparada[1];
        }
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
            $controller->setParans($this->params);
            $controller->$action();

        }
    }

    public static function navegate(string $route, string $parans = ""){

        if(empty($parans)){
            $stringredirection = "Location: http://".$_SERVER['HTTP_HOST'].$route;
        }
        else{
            $stringredirection = "Location: http://".$_SERVER['HTTP_HOST'].$route."/".$parans;
        }
        header($stringredirection);
    }
}