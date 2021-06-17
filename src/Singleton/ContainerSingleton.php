<?php


namespace src\Singleton;


use League\Container\Container;

class ContainerSingleton
{
    private static $instance;

    private function __construct(){

    }
    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public static function getInstance():Container
    {
        if(self::$instance === null){
            self::$instance = new Container();
        }
        return self::$instance;
    }
}