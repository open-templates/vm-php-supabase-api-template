<?php

declare(strict_types=1);

use App\AppFactory;
use Dotenv\Dotenv;

require dirname(__DIR__) . '/vendor/autoload.php';

$root = dirname(__DIR__, 2);
if (is_file($root . '/.env')) {
    Dotenv::createImmutable($root)->safeLoad();
}

$app = AppFactory::create();
$app->run();
