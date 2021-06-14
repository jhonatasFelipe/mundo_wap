<?php


namespace src\Repositories;


class UsuarioRepository extends Repository
{
    public function  __construct(\PDO $dBConnection)
    {
        parent::__construct("usuario", $dBConnection);
    }
}