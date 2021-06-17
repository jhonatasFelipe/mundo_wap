<?php
namespace motor;

 Class Route
{
    public $name;
    public $path;
    public $method;
    public $action;
    public $controller;

    public function __construct($method,$path,$action,$controller){
        $this->controller = $controller;
        $this->action = $action;
        $this->method = $method;
        $this->path = $path;
        }

}