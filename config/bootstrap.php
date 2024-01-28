<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Slim\App;

require_once __DIR__ . '/../vendor/autoload.php';

if (version_compare(phpversion(), '8.2.0', '<=')) {
    $message = 'This Slim-Skeleton is supported from PHP 8.2.0 or higher. Installed PHP version is: ' . phpversion();

    if ('cli' == PHP_SAPI) {
        echo $message;
    } else {
        exit($message);
    }
}

/*
 *----------------------------------------------------------------------------
 * Instantiate PHP-DI ContainerBuilder
 *----------------------------------------------------------------------------
 *
 * The dependency injection container for humans, see:
 * https://php-di.org/
 *
 */
$container = (new ContainerBuilder())
    ->addDefinitions(__DIR__ . '/container.php')
    ->build();

return $container->get(App::class);
