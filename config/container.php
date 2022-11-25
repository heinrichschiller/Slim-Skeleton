<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Middleware\ErrorMiddleware;

return [
    'settings' => function () 
    {
        return require __DIR__ . 'settings.php'; 
    },

    App::class => function (ContainerInterface $container) 
    {
        AppFactory::setContainer($container);

        return AppFactory::create();
    },

    ErrorMiddleware::class => function (ContainerInterface $container): ErrorMiddleware
    {
        $settings = $container->get('settings')['error'];
        $app = $container->get(App::class);
    }
];