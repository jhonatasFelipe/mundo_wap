<?php


namespace src\Repositories;


class UsuarioRepository extends Repository
{
    public function  __construct(string $table, \PDO $dBConnection)
    {
        parent::__construct($table, $dBConnection);
    }
}