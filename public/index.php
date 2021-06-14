<?php
 require_once "../vendor/autoload.php";

use src\Repositories\ProdutoRepository;

use src\Models\BD;
use src\Repositories\UsuarioRepository;

$connetion = BD::conectBD();

$repoProduct = new ProdutoRepository($connetion);
$repoUser = new UsuarioRepository($connetion);

$product = [
    "EAN" => "123454",
    "nome" => "laranja",
    "preco" => 20.5,
    "estoque" => 50,
    "fabricacao" => '2021-07-01'
];

try{
    $product = $repoProduct->selectAll();
    $user = $repoUser->selectAll();

    echo json_encode($product);
    echo json_encode($user);
}
catch (\PDOException $e){
    echo $e->getMessage();
}

