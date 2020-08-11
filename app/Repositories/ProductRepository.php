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
            return [
                'Указанной категории не существует'
            ];
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
        // TODO: Implement update() method.
    }

    public function delete(int $id) {
        // TODO: Implement delete() method.
    }
}
