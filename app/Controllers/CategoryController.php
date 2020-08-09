<?php

namespace App\Controllers;

use App\Entities\Category;
use App\Wrappers\AppWrapper;
use App\Wrappers\RequestWrapper;
use App\Wrappers\ResponseWrapper;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CategoryController extends BaseController {
    protected $categoryRepository;

    public function __construct(ContainerInterface $container, EntityManager $entityManager) {
        parent::__construct($container, $entityManager);
        $this->categoryRepository = $entityManager->getRepository(Category::class);
    }

    public function index(ServerRequestInterface $request, ResponseInterface $response) {
        $response = new ResponseWrapper($response);
        return $response->toJson($this->toArray($this->categoryRepository->getList()));
    }

    public function create(ServerRequestInterface $request, ResponseInterface $response) {
        $request = new RequestWrapper($request);
        $response = new ResponseWrapper($response);
        $validator = AppWrapper::getInstance()->getContainer()->get('validator');
        $validation = $validator->validate(array_merge($request->getBody(), $_FILES), [
            'name' => 'required',
            'image' => 'required|uploaded_file',
        ]);
        if ($validation->fails()) {
            return $response->toJson($validation->errors()->all());
        }
        return $response->toJson($this->categoryRepository->create(array_merge($request->getValidatedData()))->toArray());
    }

    public function update(ServerRequestInterface $request, ResponseInterface $response) {
        $request = new RequestWrapper($request);
        $response = new ResponseWrapper($response);
        $validator = AppWrapper::getInstance()->getContainer()->get('validator');
        $validation = $validator->validate(array_merge($request->getBody(), $_FILES), [
            'id' => 'required',
            'name' => 'required',
            'image' => 'uploaded_file',
        ]);
        if ($validation->fails()) {
            return $response->toJson($validation->errors()->all());
        }
        return $response->toJson($this->categoryRepository->update(array_merge($request->getValidatedData()))->toArray());
    }

    public function delete(ServerRequestInterface $request, ResponseInterface $response, $id) {
        $response = new ResponseWrapper($response);
        return $response->toJson([
            'success' => $this->categoryRepository->delete($id),
        ]);
    }
}
