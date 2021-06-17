<?php


namespace src\Controllers;


use League\Container\Container;
use motor\Controller;
use motor\Router;
use src\Repositories\DataBase\UsuarioDataBaseRepository;
use src\Singleton\ContainerSingleton;
use Twig\Environment;

class UsuarioController extends Controller
{
    protected $view;


    public function __construct(Environment $view){
        $this->view = $view;
    }

    public function index(){

    }

    public function logout(){
        session_start();
        if(isset($_SESSION["nome"]) && isset($_SESSION['login'])) {
            unset($_SESSION["nome"]);
            unset($_SESSION["login"]);
        }
        Router::navegate("/");
    }

    public function login(){
        session_start();
        $container = ContainerSingleton::getInstance();
        $errormenssage = "";
       if(isset($_POST["email"]) && isset($_POST["senha"])){
           $UsuarioRepo = $container->get(UsuarioDataBaseRepository::class);
           $result = $UsuarioRepo->find("email","=",$_POST['email']);
           if($result == []){
               $errormenssage = "Usuario não cadastrado no sistema";
           }else{
               if($result[0]['senha'] == $_POST['senha']){
                   $_SESSION["nome"] = "Jhonatas Felipe";
                   $_SESSION['login'] = true;
                   Router::navegate("/produtos");
               }
               else{
                   $errormenssage = "Usuario não cadastrado no sistema";
               }
           }
       }else{
           echo $this->view->render('Usuario/login.twig',["erro"=>$errormenssage]);
       }

    }
}