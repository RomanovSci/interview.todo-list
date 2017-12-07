<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

return EntityManager::create([
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'toor',
    'dbname'   => 'no_framework',
], Setup::createAnnotationMetadataConfiguration([__DIR__.'/../Models'], true));