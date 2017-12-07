<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

$entityManager = require __DIR__.'/../app/Core/db.php';

return ConsoleRunner::createHelperSet($entityManager);
