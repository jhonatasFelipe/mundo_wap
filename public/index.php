<?php
require_once "../vendor/autoload.php";
use motor\Bootstrap;
use motor\Router;

$config = require_once __DIR__ . "/../config.php";
$routes = require_once __DIR__ . "/../Routes.php";

$router = new Router();
$router->addRoutesAsArray($routes);
$motor = new Bootstrap($config, $router);
$motor->run();



