<?php


namespace src\ServiceProviders;


use League\Container\ServiceProvider\AbstractServiceProvider;
use src\Repositories\DataBase\UsuarioDataBaseRepository;

class UsuarioDataBaseRepositoryServiceProvider extends AbstractServiceProvider
{
    protected $provides=[
        UsuarioDataBaseRepository::class,
        \PDO::class,
    ];

    public function register()
    {
        $this->getLeagueContainer()->add(UsuarioDataBaseRepository::class)
            ->addArgument(\PDO::class);

        $this->getLeagueContainer()->add(\PDO::class)
            ->addArgument('mysql:host=localhost;dbname=mundo_wap')
            ->addArgument('root')
            ->addArgument('j2desenvolvimento')
            ->addArgument([\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    }
}