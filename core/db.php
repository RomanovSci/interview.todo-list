<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

return EntityManager::create([
    'driver'   => getenv('DB_DRIVER'),
    'dbname'   => getenv('DB_NAME'),
    'user'     => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD'),
], Setup::createAnnotationMetadataConfiguration([__DIR__.'/../app/Models'], true));
