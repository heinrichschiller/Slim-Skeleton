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
$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions(__DIR__ . '/container.php');

$container = $containerBuilder->build();

/*
 *----------------------------------------------------------------------------
 * Create Slim App instance
 *----------------------------------------------------------------------------
 *
 */
$app = $container->get(App::class);

/*
 *----------------------------------------------------------------------------
 * Register routes
 *----------------------------------------------------------------------------
 *
 * For more informations see:
 * https://www.slimframework.com/docs/v4/objects/routing.html
 *
 * Include the routes that you need. You can use web-routes for classic php
 * applications or api-routes for REST-API applications. And of course you
 * can use both.
 *
 */
(require __DIR__ . '/routes.php')($app);

/*
 *----------------------------------------------------------------------------
 * Register middleware
 *----------------------------------------------------------------------------
 *
 * For more informations see:
 * https://www.slimframework.com/docs/v4/concepts/middleware.html
 *
 */
(require __DIR__ . '/middleware.php')($app);

return $app;
