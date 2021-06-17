<?php


namespace motor;



class View
{
    public static function render(string $view,array $data){
        $config = require_once __DIR__ ."../config.php";
        include_once ($config['views']['path']);
    }
}