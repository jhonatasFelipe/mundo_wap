<?php


namespace src\ServiceProviders;


use League\Container\ServiceProvider\AbstractServiceProvider;
use src\FileRead\Validators\FileValidator;
use src\Repositories\DataBase\ProdutoDataBaseRepository;

class ValidatorServiceProvider extends AbstractServiceProvider
{
    protected $provides = [FileValidator::class];

    public function register()
    {
        $this->getLeagueContainer()->add(FileValidator::class)
            ->addArgument(ProdutoDataBaseRepository::class);

    }
}