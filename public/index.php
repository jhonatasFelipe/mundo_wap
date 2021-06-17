<?php
require_once "../vendor/autoload.php";
use motor\Bootstrap;
use motor\Router;

$routes = require_once __DIR__ . "/../Routes.php";
$GLOBALS['config'] = require_once __DIR__ . "/../config.php";
$router = new Router();
$router->addRoutesAsArray($routes);
$motor = new Bootstrap($GLOBALS['config'], $router);
$motor->run();



