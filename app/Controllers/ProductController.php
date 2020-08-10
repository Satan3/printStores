<?php

namespace App\Controllers;

use App\Entities\Category;
use App\Entities\Product;
use App\Wrappers\ResponseWrapper;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProductController extends BaseController {
    protected $productRepository;

    public function __construct(ContainerInterface $container, EntityManager $entityManager) {
        parent::__construct($container, $entityManager);
        $this->productRepository = $entityManager->getRepository(Product::class);
    }

    public function index(ServerRequestInterface $request, ResponseInterface $response, string $categoryId) {
        $response = new ResponseWrapper($response);
        $categoryRepository = $this->entityManager->getRepository(Category::class);
        return $response->toJson($this->toArray($categoryRepository->getProducts($categoryId)));
    }
}
