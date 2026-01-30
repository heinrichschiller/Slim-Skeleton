<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Slim\App;

require_once __DIR__ . '/../vendor/autoload.php';

if (PHP_VERSION_ID < 80400) {
    $message = 'This Slim-Skeleton is supported from PHP 8.4.0 or higher. Installed PHP version is: ' . PHP_VERSION;

    if (PHP_SAPI === 'cli') {
        fwrite(STDERR, $message . PHP_EOL);
        exit(1);
    }

    exit($message);
}

$container = (new ContainerBuilder())
    ->addDefinitions(__DIR__ . '/container.php')
    ->build();

return $container->get(App::class);
