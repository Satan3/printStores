<?php

use App\Controllers\{CategoryController, ProductController, ReviewController};
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
$app->addBodyParsingMiddleware();
$routeCollector = $app->getRouteCollector();
$routeCollector->setDefaultInvocationStrategy(new RequestResponseArgs());
AppWrapper::getInstance($app);

$app->get('/api', function (Request $request, Response $response) {
    $form = '<form action="/api/categories/create" method="post" enctype="multipart/form-data">
        Имя<input type="text" name="name">
        <input type="file" name="image">
        <button type="submit">Отправить</button>
    </form>';
    $response->getBody()->write($form);
    return $response;
});

$app->get('/api/categories', CategoryController::class . ':index');
$app->post('/api/categories/create', CategoryController::class . ':create');
$app->post('/api/categories/update', CategoryController::class . ':update');
$app->delete('/api/categories/delete/{id}', CategoryController::class . ':delete');
$app->get('/api/categories/{id}/products', ProductController::class . ':index');
$app->get('/api/products/all', ProductController::class . ':all');
$app->post('/api/products/create', ProductController::class . ':create');
$app->post('/api/products/update', ProductController::class . ':update');
$app->delete('/api/products/delete/{id}', ProductController::class . ':delete');
$app->get('/api/reviews', ReviewController::class . ':index');
$app->post('/api/reviews/create', ReviewController::class . ':create');

$app->run();
