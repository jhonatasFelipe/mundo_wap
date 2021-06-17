<?php


namespace src\exceptions\Route;


use Throwable;

class RouteNotFoudException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}