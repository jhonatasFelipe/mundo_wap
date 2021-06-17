<?php

use src\ServiceProviders\ProdutoDataBaseRepositoryServiceProvider;
use src\ServiceProviders\ProdutoServiceProvider;
use src\ServiceProviders\UsuarioDataBaseRepositoryServiceProvider;
use src\ServiceProviders\UsuarioServiceProvider;
use src\ServiceProviders\ValidatorServiceProvider;


 return  [
    "data_base_connection"=>[
        "host" => "localhost",
        "user" => "root",
        "password" => "j2desenvolvimento",
        "db_name" => "mundo_wap"
    ],
     "views"=>[
         "path"=>__DIR__."/Views"
     ],
    "service_providers" =>[
          ProdutoServiceProvider::class,
          UsuarioServiceProvider::class,
          ValidatorServiceProvider::class,
          ProdutoDataBaseRepositoryServiceProvider::class,
          UsuarioDataBaseRepositoryServiceProvider::class
    ]
];