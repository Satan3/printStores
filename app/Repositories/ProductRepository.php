<?php

namespace App\Repositories;

use App\Entities\Category;
use App\Entities\Product;
use App\Managers\FileManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;

class ProductRepository extends EntityRepository implements RepositoryInterface {

    protected $container;
    protected $entityClassName = Product::class;
    protected $path = 'products';
    protected $fileManager;

    public function __construct(EntityManager $em, Mapping\ClassMetadata $class) {
        parent::__construct($em, $class);
        $this->fileManager = new FileManager($this->path);
    }

    public function getList() {
        // TODO: Implement getList() method.
    }

    public function create(array $params) {
        $product = new $this->entityClassName();
        $file = $this->fileManager->save($params['image']);
        /** @var Category $category */
        if (!$category = $this->_em->getRepository(Category::class)->find($params['category_id'])) {
            throw new \Exception('Указанной категории не существует');
        }
        $product
            ->setName($params['name'])
            ->setFile($file)
            ->setCategory($category)
            ->setDiscount($params['discount'])
            ->setPrice($params['price'])
            ->setStock($params['stock'])
        ;
        $this->_em->persist($product);
        $this->_em->flush();
        return $product;
    }

    public function update(array $params) {
        $productRepository = $this->_em->getRepository($this->entityClassName);
        $categoryRepository = $this->_em->getRepository(Category::class);
        /** @var Product $product */
        if (!$product = $productRepository->find($params['id'])) {
            throw new \Exception('Указанного товара не существует');
        }
        if ($categoryId = $params['category_id']) {
            /** @var Category $category */
            if (!$category = $categoryRepository->find($categoryId)) {
                throw new \Exception('Указанной категории не существует');
            }
            $product->setCategory($category);
        }
        if ($file = $params['image']) {
            $prevFile = $product->getFile();
            $newFile = $this->fileManager->replace($prevFile, $params['image']);
            $product->setFile($newFile);
            $this->_em->remove($prevFile);
        }
        $product
            ->setName($params['name'])
            ->setStock($params['stock'])
            ->setPrice($params['price'])
            ->setDiscount($params['discount'])
        ;
        $this->_em->persist($product);
        $this->_em->flush();
        return $product;
    }

    public function delete(int $id) {
        // TODO: Implement delete() method.
    }
}
