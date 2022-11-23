<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Symfony\Component\Console\Application;

use Slim\Middleware\ErrorMiddleware;

return function(ContainerBuilder $builder)
{
    $builder->addDefinitions([
        'settings' => function()
        {
            return require ROOT_DIR . 'config/settings.php';
        },

        App::class => function(ContainerInterface $container): App
        {
            AppFactory::setContainer($container);
    
            return AppFactory::create();
        },

        Application::class => function(ContainerInterface $container): Application
        {
            $application = new Application;

            foreach($container->get('settings')['commands'] as $class) {
                $application->add($container->get($class));
            }

            return $application;
        },
        
        ErrorMiddleware::class => function(ContainerInterface $container): ErrorMiddleware
        {
            $app = $container->get(App::class);
            $errorSettings = $container->get('settings')['error'];

            return new ErrorMiddleware(
                $app->getCallableResolver(),
                $app->getResponseFactory(),
                ( bool ) $errorSettings['displayErrorDetails'],
                ( bool ) $errorSettings['logErrors'],
                ( bool ) $errorSettings['logErrorDetails'],
            );
        },

        LoggerInterface::class => function(ContainerInterface $container): Logger
        {
            $loggerSettings = $container->get('settings')['logger'];

            $logger = new Logger($loggerSettings['name']);
            $logger->pushProcessor(new UidProcessor);

            $streamHandler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($streamHandler);

            return $logger;
        }
    ]);
};