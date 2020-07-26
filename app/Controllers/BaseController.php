<?php

namespace App\Controllers;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

abstract class BaseController {
    protected $container;
    protected $entityManager;

    public function __construct(ContainerInterface $container, EntityManager $entityManager) {
        $this->container = $container;
        $this->entityManager = $entityManager;
    }
}
