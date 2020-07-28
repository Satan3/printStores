<?php

use App\Entities\File;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Psr\Container\ContainerInterface;

$isDevMode = $_ENV['DEV_MODE'];
$baseDir = __DIR__ . sprintf('..\..\%s\Entities', $_ENV['BASE_DIR']);
$config = Setup::createAnnotationMetadataConfiguration([$baseDir], $isDevMode, null, null, false);
$connection = [
    'dbname' => $_ENV['DB_DATABASE'],
    'user' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
    'host' => $_ENV['DB_HOST'],
    'driver' => $_ENV['DB_DRIVER'],
];

return [
    EntityManager::class => function (ContainerInterface $container) use ($connection, $config) {
        return EntityManager::create($connection, $config);
    },
    'validator' => DI\get('\Rakit\Validation\Validator'),
    'baseDir' => __DIR__,
    'fileRepository' => function(ContainerInterface $container) {
        return $container->get(EntityManager::class)->getRepository(File::class);
    },
];
