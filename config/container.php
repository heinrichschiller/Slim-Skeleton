<?php

declare(strict_types=1);

use App\Factory\LoggerFactory;
use App\Support\Config;
use Psr\Container\ContainerInterface;
use Selective\BasePath\BasePathMiddleware;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Middleware\ErrorMiddleware;

return [
    'settings' => function () {
        return require __DIR__ . '/settings.php';
    },

    Config::class => function (ContainerInterface $container): Config {
        $settings = (array) $container->get('settings');

        return new Config($settings);
    },

    App::class => function (ContainerInterface $container) {
        $app = AppFactory::createFromContainer($container);

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
    },

    BasePathMiddleware::class => function (ContainerInterface $container) {
        return new BasePathMiddleware($container->get(App::class));
    },
    
    ErrorMiddleware::class => function (ContainerInterface $container): ErrorMiddleware {
        $settings = (array) $container->get('settings')['error'];
        $app = $container->get(App::class);

        $logger = $container->get(LoggerFactory::class)
            ->addFileHandler('error.log')
            ->createLogger();

        $errorMiddleware = new ErrorMiddleware(
            $app->getCallableResolver(),
            $app->getResponseFactory(),
            (bool) $settings['display_error_details'],
            (bool) $settings['log_errors'],
            (bool) $settings['log_error_details'],
            $logger
        );

        return $errorMiddleware;
    },

    LoggerFactory::class => function (ContainerInterface $container): LoggerFactory {
        return new LoggerFactory($container->get('settings')['logger']);
    },
];
