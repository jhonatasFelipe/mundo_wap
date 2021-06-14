<?php


namespace src\Repositories;


class ProdutoRepository extends Repository
{
    public function __construct(\PDO $dBConnection)
    {
        parent::__construct("produto", $dBConnection);
    }
}