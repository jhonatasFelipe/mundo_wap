<?php


namespace src\FileRead\Validators;


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


    public function headerValidate(){
        for($i = 0;$i <=4;$i++)
            if ($this->head[$i] !== $this->defaulthead[$i]) {
                return false;
            }
        return true;
    }

    public function dataValidate(){
        foreach ($this->data as $rows){
            for($i = 0;$i <=4;$i++){
                switch ($i){
                    case 0:
                        // campo EAN
                        if(!is_numeric($rows[$i]) || empty($rows[$i])){
                            return false;
                        }
                        break;
                    case 1:
                        // campo nome do produto
                        if(!is_string($rows[$i]) || empty($rows[$i])){
                            return false;
                        }
                        break;
                    case 2:
                        //campo preço
                        if(!is_numeric($rows[$i]) || empty($rows[$i])){
                            return false;
                        }
                        break;
                    case 3:
                        //campo estoque
                        if(!is_numeric($rows[$i]) || empty($rows[$i])){
                            return false;
                        }
                        break;
                    case 4:
                        if(!empty($rows[$i])){
                           $data =  explode("-",$rows[$i]);
                           $a = $data[0];
                           $m = $data[1];
                           $d = $data[2];
                           $today = new \DateTime('');
                           if(!checkdate($m,$d,$a) || $today < $rows[$i]){
                                return false;
                            }
                        }
                        break;
                }
            }
        }
    return true;
    }

    public function isValid():bool{
        if($this->headerValidate() && $this->dataValidate()){
            return true;
        }
        return false;
    }
}