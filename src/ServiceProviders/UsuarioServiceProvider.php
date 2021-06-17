<?php


namespace src\ServiceProviders;


use src\Controllers\UsuarioController;
use src\Models\Usuario;
use League\Container\ServiceProvider\AbstractServiceProvider;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class UsuarioServiceProvider extends AbstractServiceProvider
{
   protected $provides = [UsuarioController::class,
       FilesystemLoader::class, Environment::class];

    public function register(): void
    {
        $this->getLeagueContainer()->add(UsuarioController::class)
            ->addArgument(Environment::class);
    }
}