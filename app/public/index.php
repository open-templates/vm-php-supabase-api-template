<?php

declare(strict_types=1);

use App\AppFactory;
use Dotenv\Dotenv;

require dirname(__DIR__) . '/vendor/autoload.php';

$appRoot = dirname(__DIR__);
foreach ([$appRoot, dirname($appRoot)] as $envRoot) {
    if (is_file($envRoot . '/.env')) {
        Dotenv::createImmutable($envRoot)->safeLoad();
        break;
    }
}

$app = AppFactory::create();
$app->run();
