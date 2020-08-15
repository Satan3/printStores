<?php

use App\Controllers\CategoryController;
use App\Controllers\ProductController;
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

$app->get('/', function (Request $request, Response $response) {
    $form = '<form action="/products/update" method="post" enctype="multipart/form-data">
        Название<input type="text" name="name">
        Категория(id)<input type="text" name="category_id">
        Цена<input type="text" name="price">
        Скидка(%)<input type="text" name="discount">
        Название метки(акции)<input type="text" name="stock">
        Изображение<input type="file" name="image">
        <input type="hidden" name="id" value="10">
        <button type="submit">Отправить</button>
    </form>';
    $response->getBody()->write($form);
    return $response;
});

$app->get('/categories', CategoryController::class . ':index');
$app->post('/categories/create', CategoryController::class . ':create');
$app->post('/categories/update', CategoryController::class . ':update');
$app->delete('/categories/delete/{id}', CategoryController::class . ':delete');
$app->get('/categories/{id}/products', ProductController::class . ':index');
$app->post('/products/create',  ProductController::class . ':create');
$app->post('/products/update', ProductController::class . ':update');
$app->delete('/products/delete/{id}', ProductController::class . ':delete');

$app->run();
