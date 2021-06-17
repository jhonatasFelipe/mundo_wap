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

        $config  = $GLOBALS['config'];
        $this->getLeagueContainer()->add(\PDO::class)
            ->addArgument('mysql:host='.$config['data_base_connection']['host'].';dbname='.$config['data_base_connection']['db_name'])
            ->addArgument($config['data_base_connection']['user'])
            ->addArgument($config['data_base_connection']['password'])
            ->addArgument([\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    }
}