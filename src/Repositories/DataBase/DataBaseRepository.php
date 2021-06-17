<?php
namespace src\Repositories\DataBase;



Class DataBaseRepository{
    protected $table;
    protected $dBConnection;

    public function __construct(string $table , \PDO $dBConnection){
        $this->table = $table;
        $this->dBConnection = $dBConnection;
    }

    /*
     *  Array $values array associativo com os campos e os valores para serem inseridos no banco de dados;
     * */

    public function insert(array $values)
    {
        try
        {
        $sql = "INSERT INTO " . $this->table . " ( ";

        // Coloca o nome das colunas no insert
        $first = true;
        foreach ($values as $key => $value) {
            if ($first) {
                $sql = $sql . $key;
                $first = false;
            } else {
                $sql = $sql . ", " . $key;
            }
        }

        $sql = $sql . " ) VALUES ( ";
        // Coloca os paramentros de bindings no insert;
        $first = true;
        foreach ($values as $key => $value) {
            if ($first) {
                $sql = $sql . ":" . $key;
                $first = false;
            } else {
                $sql = $sql . ", :" . $key;
            }
        }
            $sql = $sql." );";
        // faz o binding com os valores do array
        $stmt = $this->dBConnection->prepare($sql);

        foreach ($values as $key => $value) {
            $stmt->bindvalue(":".$key, $value);
        }

        $stmt->execute();
    }
    catch(\PDOExeption $err){
        echo "Não foi possivel inserir no banco de dados " . $err->getMessage();
    }

    }

    public function delete(string $feild,string $value){
        try {
            $sql = "DELETE FROM " . $this->table . " WHERE " . $feild . "=" . $value;
            $stmt = $this->dBConnection->query($sql);
            $stmt->execute();
            return true;
        }catch (\PDOException $err){
            return false;
        }
    }

    protected  function update(){

    }


    public function selectAll(){
        $sql = "SELECT * FROM ". $this->table;
        $consulta = $this->dBConnection->query($sql);

        try
        {
           return  $consulta->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch (\PDOException $err)
        {
            echo " Não foi possivel selecionar os dados" . $err->getMessage();
        }

    }

    public function find(string $field,string $operator,string $value){
        $sql = "SELECT * FROM ". $this->table.
            " WHERE ".$field.$operator."'".$value."'";
        $consulta = $this->dBConnection->query($sql);
        try
        {
            return  $consulta->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch (\PDOException $err)
        {
            echo " Não foi possivel selecionar os dados" . $err->getMessage();
        }
    }
}
