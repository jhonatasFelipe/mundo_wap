<?php


namespace src\exceptions\DataBase;


use Throwable;

class DuplicateValueException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}