<?php


namespace src\ServiceProviders;


use League\Container\ServiceProvider\BootableServiceProviderInterface;
use src\Controllers\ProdutoController;
use League\Container\ServiceProvider\AbstractServiceProvider;
use src\Singleton\ContainerSingleton;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ProdutoServiceProvider extends AbstractServiceProvider
{

    protected  $provides =[
        ProdutoController::class,
        Environment::class,
        FilesystemLoader::class
    ];



    public function register(): void
    {

        $this->getLeagueContainer()->add(ProdutoController::class)
            ->addArgument(Environment::class);

    }


}