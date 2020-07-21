<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Dotenv\Dotenv;

require_once __DIR__ . './vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$isDevMode = $_ENV['DEV_MODE'];
$baseDir = __DIR__ . sprintf('\%s\Entities', $_ENV['BASE_DIR']);
$config = Setup::createAnnotationMetadataConfiguration([$baseDir],  $isDevMode, null, null, false);
$connection = [
    'dbname' => $_ENV['DB_DATABASE'],
    'user' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
    'host' => $_ENV['DB_HOST'],
    'driver' => $_ENV['DB_DRIVER'],
];
$entityManager = EntityManager::create($connection, $config);
