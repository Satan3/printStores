<?php

namespace App\Repositories;

use App\Entities\Category;
use App\Managers\FileManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;

class CategoryRepository extends EntityRepository implements  RepositoryInterface {

    protected $container;
    protected $entityClassName = Category::class;
    protected $path = 'categories';
    protected $fileManager;

    public function __construct(EntityManagerInterface $em, Mapping\ClassMetadata $class) {
        parent::__construct($em, $class);
        $this->fileManager = new FileManager($this->path);
    }

    public function getList() {
        return $this->findAll();
    }

    public function create(array $params) {
         $category = new Category();
         $file = $this->fileManager->save($params['image']);
         $category->setName($params['name']);
         $category->setFile($file);
         $this->_em->persist($category);
         $this->_em->flush();
         return $category;
    }

    public function update(array $params) {
        /** @var Category $category */
       if (!$category = $this->_em->find($this->entityClassName, $params['id'])) {
           throw new \Exception('Отсутствует указанная категория');
       }
       $category->setName($params['name']);
       if ($params['image']) {
           $prevFile = $category->getFile();
           $newFile = $this->fileManager->replace($prevFile, $params['image']);
           $category->setFile($newFile);
           $this->_em->remove($prevFile);
       }
       $this->_em->persist($category);
       $this->_em->flush();
       return $category;
    }

    public function delete(int $id) {
        /** @var Category $category */
        if (!$category = $this->_em->find($this->entityClassName, $id)) {
            throw new \Exception('Не найдена указанная категория');
        }
        $this->fileManager->delete($category->getFile()->getPath());
        $this->_em->remove($category);
        $this->_em->flush();
    }

    public function getProducts(int $id) {
        /** @var Category $category */
        if (!$category = $this->_em->find($this->entityClassName, $id)) {
           return [];
        }
        return $category->getProducts();
    }
}
