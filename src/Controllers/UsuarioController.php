<?php


namespace src\Controllers;


use League\Container\Container;
use motor\Controller;
use Twig\Environment;

class UsuarioController extends Controller
{
    protected $view;


    public function __construct(Environment $view){
        $this->view = $view;
    }

    public function index(){
       echo $this->view->render('Usuario/index.twig');
    }

    public function login(){
        echo $this->view->render('Usuario/login.twig');
    }
}