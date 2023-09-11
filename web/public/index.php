<?php

require_once __DIR__ . '/../app/vendor/autoload.php';

$env = new Symfony\Component\Dotenv\Dotenv();
$env->load(__DIR__ . '/../.env');

require_once __DIR__ . '/../app/src/bootstrap.php';
require_once __DIR__ . '/../app/src/routes.php';

