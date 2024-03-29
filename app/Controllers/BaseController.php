<?php

namespace App\Controllers;

use App\Entities\BaseEntity;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

abstract class BaseController {
    protected $container;
    protected $entityManager;

    public function __construct(ContainerInterface $container, EntityManager $entityManager) {
        $this->container = $container;
        $this->entityManager = $entityManager;
    }

    public function toArray($items) {
        $fGetList = function (BaseEntity $item) {
            return $item->toArray();
        };
        if (!is_array($items)) {
            $items = $items->toArray();
        }
        return array_map($fGetList, $items);
    }
}
