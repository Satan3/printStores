<?php

namespace App\Controllers;

use App\Entities\Category;
use App\Wrappers\RequestWrapper;
use App\Wrappers\ResponseWrapper;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Rakit\Validation\Validator;

class CategoryController extends BaseController {
    protected $categoryRepository;

    public function __construct(ContainerInterface $container, EntityManager $entityManager) {
        parent::__construct($container, $entityManager);
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
        $request = new RequestWrapper($request);
        $response = new ResponseWrapper($response);
        $validator = new Validator();
        $validation = $validator->validate(array_merge($request->getBody(), $_FILES), [
            'name' => 'required',
            'image' => 'required|uploaded_file',
        ]);
        if ($validation->fails()) {
            return $response->toJson($validation->errors());
        }
        return $response->toJson($this->categoryRepository->create(array_merge($request->getValidatedData()))->toArray());
    }
}
