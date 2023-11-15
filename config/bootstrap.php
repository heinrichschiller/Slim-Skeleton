<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Slim\App;

require_once __DIR__ . '/../vendor/autoload.php';

/*
 *----------------------------------------------------------------------------
 * Php version validation
 *----------------------------------------------------------------------------
 *
 * PHP_VERSION_ID is available as of PHP 5.2.7.
 * More about predefined constants, see:
 * https://www.php.net/manual/en/reserved.constants.php
 *
 */
if (!defined('PHP_VERSION_ID') || 80100 > PHP_VERSION_ID) {
    if ('cli' == PHP_SAPI) {
        echo 'This Slim-Skeleton support PHP 8.1 or later.';
    } else {
        echo <<<HTML
            <div>
                <p>This Slim-Skeleton supports PHP 8.1 or later.</p>
            </div>
        HTML;
        exit(1);
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
