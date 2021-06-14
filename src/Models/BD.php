<?php


namespace src\Models;
 define('HOST', "localhost");
 define('USER', 'root');
 define('PASS', 'j2desenvolvimento');
 define('DB_NAME', 'mundo_wap');

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