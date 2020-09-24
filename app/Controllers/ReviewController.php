<?php

namespace App\Controllers;

use App\Entities\Review;
use App\Wrappers\AppWrapper;
use App\Wrappers\RequestWrapper;
use App\Wrappers\ResponseWrapper;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Rakit\Validation\Validator;

class ReviewController extends BaseController {

    protected $reviewRepository;

    public function __construct(ContainerInterface $container, EntityManager $entityManager) {
        parent::__construct($container, $entityManager);
        $this->reviewRepository = $entityManager->getRepository(Review::class);
    }

    public function index(ServerRequestInterface $request, ResponseInterface $response) {
        $response = new ResponseWrapper($response);
        return $response->toJson($this->toArray($this->reviewRepository->getList()));
    }

    public function create(ServerRequestInterface $request, ResponseInterface $response) {
        try {
            $request = new RequestWrapper($request);
            $response = new ResponseWrapper($response);
            /** @var Validator $validator */
            $validator = AppWrapper::getInstance()->getContainer()->get('validator');
            $validation = $validator->validate($request->getBody(), [
                'personName' => 'required',
                'rating' => 'required',
                'message' => 'required',
            ]);
            if ($validation->fails()) {
                throw new \Exception(json_encode($validation->errors()->toArray()));
            }
            return $response->toJson($this->reviewRepository->create($request->getValidatedData())->toArray());
        } catch (\Exception $e) {
            return $response->toJson(['success' => true, 'message' => $e->getMessage()]);
        }
    }

}
