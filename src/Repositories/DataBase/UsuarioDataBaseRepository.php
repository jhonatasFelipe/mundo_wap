<?php


namespace src\Repositories\DataBase;



class UsuarioDataBaseRepository extends DataBaseRepository
{
    public function  __construct(\PDO $dBConnection)
    {
        parent::__construct("usuario", $dBConnection);
    }


}