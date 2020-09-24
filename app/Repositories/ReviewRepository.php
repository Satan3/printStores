<?php

namespace App\Repositories;

use App\Entities\Review;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;

class ReviewRepository extends EntityRepository implements RepositoryInterface {

    protected $container;

    public function __construct(EntityManagerInterface $em, Mapping\ClassMetadata $class) {
        parent::__construct($em, $class);
    }

    public function getList() {
        return $this->findAll();
    }

    public function create(array $params) {
        $review = new Review();
        $review->setPersonName($params['personName'])
            ->setCreatedAt(new \DateTime())
            ->setMessage($params['message'])
            ->setRating($params['rating']);
        $this->_em->persist($review);
        $this->_em->flush();
        return $review;
    }

    public function update(array $params) {
        // TODO: Implement update() method.
    }

    public function delete(int $id) {
        // TODO: Implement delete() method.
    }
}
