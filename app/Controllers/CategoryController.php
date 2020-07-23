<?php

namespace App\Controllers;

use App\Builders\CategoryBuilder;
use App\Entities\Category;
use App\Wrappers\ResponseWrapper;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CategoryController extends BaseController {
    protected $container;
    protected $categoryRepository;

    public function __construct(ContainerInterface $container, EntityManager $entityManager) {
        $this->container = $container;
        $this->categoryRepository = $entityManager->getRepository(Category::class);
    }

    public function index(ServerRequestInterface $request, ResponseInterface $response) {
        $response = new ResponseWrapper($response);
        $fGetList = function (Category $item) {
            return $item->toArray();
        };
        return $response->toJson(array_map($fGetList, $this->categoryRepository->getList()));
    }

    public function create(ServerRequestInterface $request, ResponseInterface $response) {
        $response = new ResponseWrapper($response);
        $dto = (new CategoryBuilder())->buildDTO($request->getQueryParams());
        return $response->toJson($this->categoryRepository->create($dto)->toArray());
    }
}
