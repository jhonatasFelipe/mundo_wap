<?php


namespace src\Controllers;



use motor\Controller;
use motor\Router;
use PhpOffice\PhpSpreadsheet\IOFactory;
use src\FileRead\Filter\ProductsFilter;
use src\Repositories\DataBase\ProdutoDataBaseRepository;
use src\Singleton\ContainerSingleton;
use src\FileRead\Validators\FileValidator;
use Twig\Environment;

class ProdutoController extends  Controller
{
    protected $view;


    public function __construct(Environment $view){
        $this->view = $view;
    }

    public function index(){
        session_start();
        if(!isset($_SESSION['login'])){
            Router::navegate("/");
        }

        $container = ContainerSingleton::getInstance();
        $repo = $container->get(ProdutoDataBaseRepository::class);
        $data = $repo->selectAll();
        echo $this->view->render("produtos/lista.twig",["produtos" => $data, "param"=>$this->parans]);
    }

    public function readFile(){

        /*
         * Pega o arquivo que foi feito o upload e move para pasta Arquivos_excel, depois
         * pega o caminho do arquivo e joa na variavel file.
         * */
        move_uploaded_file($_FILES['arquivo']['tmp_name'],"./arquivos_excel/".$_FILES['arquivo']['name']);
        $container = ContainerSingleton::getInstance();
        $file = __DIR__ . "/../../public/arquivos_excel/".$_FILES['arquivo']['name'];
        /*
         * $xls é a variavel que recebe os dados da planilha
         * logo depois é ultilizado o validador que recebe os parametros do cabeçalho , e valida o
         * cabeçalho e os dados da planilha
         * */
        $xls = \SimpleXLSX::parse($file);
        $xls->setDateTimeFormat('Y-m-d');
        $validator = $container->get(FileValidator::class);
        $validator->setDefaultHead(["EAN", "NOME PRODUTO","PREÇO","ESTOQUE","DATA FABRICAÇÃO"]);
        $validator->setFile($xls->rows());

        /*
         * Depois de validado os dados da planilha eles são persistidos no banco de dados
         * é retirada a primeira linha da matriz porque ela é o cabeçalho.
         *
         * */
        if($validator->isValid()){
           $database =  $container->get(ProdutoDataBaseRepository::class);
           $fordatabase = $xls->rows();

           // aqui remove a linha de cabeçalho
           array_shift($fordatabase);
           //itera sobre todas as linhas da tabela e e presiste no banco
           foreach ( $fordatabase as $row){
               $fabricacao = $row[4] == "" ? null : $row[4];
              $database->insert([
                  'EAN'=>$row[0],
                  'nome'=>$row[1],
                  'preco'=>$row[2],
                  'estoque'=>$row[3],
                  'fabricacao'=>$fabricacao
              ]);
           }
        }
       Router::navegate("/produtos");
    }

    public function delete(){
        $container = ContainerSingleton::getInstance();
        $produtoRepo = $container->get(ProdutoDataBaseRepository::class);

        if($produtoRepo->delete("EAN",$this->parans)){
            Router::navegate("/produtos");
        }
    }
}