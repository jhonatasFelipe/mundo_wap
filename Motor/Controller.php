<?php


namespace motor;


use League\Container\Container;
use Twig\Environment;

class Controller

{
 protected $parans;

 public function setParans($parans){
     $this->parans = $parans;
}

}