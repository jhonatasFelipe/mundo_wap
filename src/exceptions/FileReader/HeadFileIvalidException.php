<?php


namespace src\exceptions\FileReader;


use Throwable;

class HeadFileIvalidException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}