<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

$entityManager = require __DIR__.'/../core/db.php';

return ConsoleRunner::createHelperSet($entityManager);
