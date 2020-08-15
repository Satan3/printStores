<?php

namespace App\Controllers;

use App\Entities\Category;
use App\Entities\Product;
use App\Wrappers\AppWrapper;
use App\Wrappers\RequestWrapper;
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

    public function create(ServerRequestInterface $request, ResponseInterface $response) {
        try {
            $request = new RequestWrapper($request);
            $response = new ResponseWrapper($response);
            $validator = AppWrapper::getInstance()->getContainer()->get('validator');
            $validation = $validator->validate(array_merge($request->getBody(), $_FILES), [
                'name' => 'required',
                'image' => 'required|uploaded_file',
                'price' => 'required',
                'discount' => 'default:0',
                'stock' => 'default:""',
                'category_id' => 'integer|required',
            ]);
            if ($validation->fails()) {
                throw new \Exception(json_encode($validation->errors()->toArray()));
            }
            return $response->toJson($this->productRepository->create($request->getValidatedData())->toArray());
        } catch (\Exception $e) {
            return $response->toJson(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function update(ServerRequestInterface $request, ResponseInterface $response) {
        try {
            $request = new RequestWrapper($request);
            $response = new ResponseWrapper($response);
            $validator = AppWrapper::getInstance()->getContainer()->get('validator');
            $validation = $validator->validate(array_merge($request->getBody(), $_FILES), [
               'name' => 'required',
               'image' => 'uploaded_file',
               'price' => 'required',
               'discount' => 'default:0',
               'stock' => 'default:""',
               'category_id' => 'integer|required',
            ]);
            if ($validation->fails()) {
                throw new \Exception(json_encode($validation->errors()->toArray()));
            }
            return $response->toJson($this->productRepository->update($request->getValidatedData())->toArray());
        } catch (\Exception $e) {
            return $response->toJson(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
