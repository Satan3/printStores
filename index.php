<?php

use App\Controllers\CategoryController;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once __DIR__ . '/bootstrap.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(require_once './di-config.php');
$container = $containerBuilder->build();
AppFactory::setContainer($container);
$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write('Hello pidar');
    return $response;
});

$app->get('/categories', CategoryController::class . ':index');
$app->post('/categories/create', CategoryController::class . ':create');

$app->run();
