<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;

require_once __DIR__ . '\bootstrap.php';

$isDevMode = $_ENV['DEV_MODE'];
$baseDir = __DIR__ . sprintf('\%s', $_ENV['BASE_DIR']);
$config = Setup::createAnnotationMetadataConfiguration([$baseDir], $isDevMode, null, null, false);
$connection = [
    'dbname' => $_ENV['DB_DATABASE'],
    'user' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
    'host' => $_ENV['DB_HOST'],
    'driver' => $_ENV['DB_DRIVER'],
];
$entityManager = \Doctrine\ORM\EntityManager::create($connection, $config);

return ConsoleRunner::createHelperSet($entityManager);
