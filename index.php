<?php

use App\Controllers\CategoryController;
use App\Wrappers\AppWrapper;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Handlers\Strategies\RequestResponseArgs;

require_once __DIR__ . '/bootstrap.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(require_once './di-config.php');
$container = $containerBuilder->build();
AppFactory::setContainer($container);
$app = AppFactory::create();
$routeCollector = $app->getRouteCollector();
$routeCollector->setDefaultInvocationStrategy(new RequestResponseArgs());
AppWrapper::getInstance($app);

$app->get('/', function (Request $request, Response $response) {
    $form = '<form action="/categories/create" method="post" enctype="multipart/form-data">
        <input type="text" name="name">
        <input type="file" name="image">
        <button type="submit">Отправить</button>
    </form>';
    $response->getBody()->write($form);
    return $response;
});

$app->get('/categories', CategoryController::class . ':index');
$app->post('/categories/create', CategoryController::class . ':create');

$app->run();
