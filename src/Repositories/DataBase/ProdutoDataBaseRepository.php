<?php


namespace src\Repositories\DataBase;


class ProdutoDataBaseRepository extends DataBaseRepository
{
    public function __construct(\PDO $dBConnection)
    {
        parent::__construct("produto", $dBConnection);
    }
}