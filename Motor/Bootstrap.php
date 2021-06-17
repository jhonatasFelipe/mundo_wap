<?php


namespace motor;


use League\Container\Container;
use src\Controllers\ProdutoController;
use src\Controllers\UsuarioController;
use src\Singleton\ContainerSingleton;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Bootstrap
{
    public $config;
    public $router;
    public $activeRoute;

    public  function  __construct(Array $config, Router $router)
    {
        $this->router = $router;
        $this->config = $config;
        $this->activeRoute = $_SERVER['REQUEST_URI'];
    }

    public function run(){
        $this->registerProviders();
        $this->activeView();

        $this->router->dispatch();
    }

    public function registerProviders(){
        $services = $this->config["service_providers"];
        $container = ContainerSingleton::getInstance();

        foreach ($services as  $service){
            $container->addServiceProvider($service);
        }
    }

    public function activeView(){
        $contaier = ContainerSingleton::getInstance();

        $contaier->add(Controller::class)
            ->addArgument(Environment::class);

        $contaier->add( Environment::class)
            ->addArgument(FilesystemLoader::class);

        $contaier ->add( FilesystemLoader::class)
        ->addArgument($this->config['views']['path']);





    }







}