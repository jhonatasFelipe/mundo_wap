<?php
namespace src\Repositories;


Class Repository{
    protected $table;
    protected $dBConnection;

    public function __construct(string $table , \PDO $dBConnection){
        $this->table = $table;
        $this->dBConnection = $dBConnection;
    }

    /*
     *  Array $values array associativo com os campos e os valores para serem inseridos no banco de dados;
     * */
    public function insert(array $values){
        $sql = "INSERT INTO ". $this->table ."(";

        // Coloca o nome das colunas no insert
        $primeiro = true;
        foreach ($values as $key => $value){
            if($primeiro){
                $sql = $sql. $key;
                $primeiro = false;
            }
            else
            {
               $sql = $sql.",".$key;
            }
        }

        $sql = $sql.") VALUES (";
        // Coloca os paramentros de bindings no insert;
        $primeiro = true;
        foreach ($values as $key => $value){
            if($primeiro){
                $sql = $sql. ":".$key;
                $primeiro = false;
            }
            else
            {
                $sql = $sql.", :".$key;
            }
        }

        // faz o binding com os valores do array
        $stmt = $this->dBConnection->prepare($sql);
        foreach ($values as  $key => $value){
            $stmt->bindValue(":".$key, $value);
        }

        $stmt->execute();

    }

    protected function delete(){

    }

    protected  function update(){

    }

    protected function selectAll(){

    }
}
