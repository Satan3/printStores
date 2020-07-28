<?php

namespace App\Repositories;

use App\Entities\Category;
use App\Managers\FileManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;

class CategoryRepository extends EntityRepository implements  RepositoryInterface {

    protected $container;
    protected $path = 'categories';

    public function __construct(EntityManagerInterface $em, Mapping\ClassMetadata $class) {
        parent::__construct($em, $class);
    }

    public function create(array $params) {
         $category = new Category();
         $fileManager = new FileManager($this->path);
         $file = $fileManager->save($params['image']);
         $category->setName($params['name']);
         $category->setFile($file);
         $this->_em->persist($category);
         $this->_em->flush();
         return $category;
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
