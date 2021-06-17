<?php


namespace src\FileRead\Validators;


use src\exceptions\DataBase\DuplicateValueException;
use src\exceptions\FileReader\FieldIvalidExeption;
use src\exceptions\FileReader\HeadFileIvalidException;
use src\Repositories\DataBase\ProdutoDataBaseRepository;

class FileValidator
{
    private $head;
    private $data;
    private $defaulthead;
    private $repo;
    public function __construct(ProdutoDataBaseRepository $repo){
        $this->repo = $repo;
    }

    public function setFile(array $data){
        $this->head = array_shift($data);
        $this->data = $data;
    }

    public function setDefaultHead(Array $head){
        $this->defaulthead = $head;
    }

    public  function verificaDuplicidadeBanco($value){
        $result = $this->repo->find("EAN" ,"=" ,$value);
        if(count($result) > 0){
            throw new DuplicateValueException("um produto com o EAN ".$value." já está Cadastrado no banco de dados");
        }
    }


    public function headerValidate(){
        for($i = 0;$i <=4;$i++)
            if ($this->head[$i] !== $this->defaulthead[$i]) {
                throw new HeadFileIvalidException("cabeçalho da planilha é inválido, verifique os titulos do cabeçalho");
            }
        return true;
    }

    public function dataValidate()
    {
        foreach ($this->data as $rows) {
            for ($i = 0; $i <= 4; $i++) {
                switch ($i) {
                    case 0:
                        // campo EAN
                        if (!is_numeric($rows[$i]) || empty($rows[$i])) {
                            throw  new FieldIvalidExeption("Campo EAN invalido");
                        }
                        $this->verificaDuplicidadeBanco($rows[$i]);
                        break;
                    case 1:
                        // campo nome do produto
                        if (!is_string($rows[$i]) || empty($rows[$i])) {
                            throw  new FieldIvalidExeption("Campo Produto invalido");
                        }
                        break;
                    case 2:
                        //campo preço
                        if (!is_numeric($rows[$i]) || empty($rows[$i])) {
                            throw  new FieldIvalidExeption("Campo Preço invalido");
                        }
                        break;
                    case 3:
                        //campo estoque
                        if (!is_numeric($rows[$i]) || empty($rows[$i])) {
                            throw  new FieldIvalidExeption("Campo Estoque invalido");
                        }
                        break;
                    case 4:
                        if (!empty($rows[$i])) {
                            $data = explode("-", $rows[$i]);
                            $a = $data[0];
                            $m = $data[1];
                            $d = $data[2];
                            $today = new \DateTime('');
                            if (!checkdate($m, $d, $a) || $today < $rows[$i]) {
                                throw new FieldIvalidExeption("Campo Data invalido");
                            }
                        }
                        break;
                }
            }
        }
    }

    public function validate(){
        $this->headerValidate();
        $this->dataValidate();
    }
}