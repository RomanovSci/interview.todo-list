<?php

require_once __DIR__ . '/../vendor/autoload.php';

$env_variables = require_once __DIR__ . '/../config/env-local.php';

foreach ($env_variables as $variable => $value) {
    putenv("$variable=$value");
}

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/error_handler.php';
require_once __DIR__ . '/router.php';