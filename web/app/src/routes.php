<?php

use App\Controller\OperationController;
use App\Helpers\Container;
use App\Helpers\Router;

/**
 * @var Router $router
 */
$router = (new Container())->get(Router::class);

$router->addRoute('post', '/operation', [OperationController::class, 'addOperation']);

$router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);