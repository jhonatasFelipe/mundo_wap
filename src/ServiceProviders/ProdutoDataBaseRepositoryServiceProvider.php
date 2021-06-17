<?php


namespace src\ServiceProviders;


use League\Container\ServiceProvider\AbstractServiceProvider;
use src\Repositories\DataBase\ProdutoDataBaseRepository;

class ProdutoDataBaseRepositoryServiceProvider extends AbstractServiceProvider
{
    protected $provides=[
        ProdutoDataBaseRepository::class,
        \PDO::class,
    ];

    public function register()
    {
        $this->getLeagueContainer()->add(ProdutoDataBaseRepository::class)
            ->addArgument(\PDO::class);

        $this->getLeagueContainer()->add(\PDO::class)
        ->addArgument('mysql:host=localhost;dbname=mundo_wap')
        ->addArgument('root')
            ->addArgument('j2desenvolvimento')
        ->addArgument([\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    }
}