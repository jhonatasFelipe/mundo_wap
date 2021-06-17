<?php


namespace src\Models;


 Abstract class  BD
{
     static public function conectBD(){

        try
        {
            $opcoes = array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION);
            return new \PDO('mysql:host='.HOST.';dbname='.DB_NAME,USER,PASS, $opcoes);
        }
        catch(\PDOException $err){
            echo " Erro ao Conectar com o Banco de dados" . $err->getMessage();
        }
    }
}