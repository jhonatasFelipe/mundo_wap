<?php

use motor\Route;
use src\Controllers\ProdutoController;
use src\Controllers\UsuarioController;
use src\ServiceProviders\ProdutoServiceProvider;

return[
    new Route("GET","/produtos","index",ProdutoController::class),
    new Route("GET","/readfile","readFile",ProdutoController::class),
    new Route( "GET","/users","index",UsuarioController::class),
    new Route( "GET","/login","login",UsuarioController::class)
];

