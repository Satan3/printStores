<?php

namespace App\Repositories;

use App\DTO\BaseDTO;
use App\Entities\Category;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;

class CategoryRepository extends EntityRepository implements  RepositoryInterface {

    public function __construct(EntityManagerInterface $em, Mapping\ClassMetadata $class) {
        parent::__construct($em, $class);
    }

    public function create(BaseDTO $dto) {
         $category = new Category();
         $category->setName($dto->get('name'));
         $this->_em->persist($category);
         $this->_em->flush();
    }

    public function getList() {
        return $this->findAll();
    }

    public function update() {
        // TODO: Implement update() method.
    }

    public function delete() {
        // TODO: Implement delete() method.
    }
}
