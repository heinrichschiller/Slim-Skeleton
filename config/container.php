<?php

declare(strict_types=1);

use App\Factory\LoggerFactory;
use App\Handler\NotFoundHandler;
use Psr\Container\ContainerInterface;
use Selective\BasePath\BasePathMiddleware;
use Selective\Config\Configuration;
use Slim\App;
use Slim\Exception\HttpNotFoundException;
use Slim\Factory\AppFactory;
use Slim\Middleware\ErrorMiddleware;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputOption;

return [
    Configuration::class => function () {
        return new Configuration(require __DIR__ . '/settings.php');
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

    Application::class => function (ContainerInterface $container) {
        $application = new Application();

        $application->getDefinition()->addOption(
            new InputOption('--env', '-e', InputOption::VALUE_REQUIRED, 'The Environment name.', 'dev')
        );

        foreach ($container->get('settings')['commands'] as $class) {
            $application->add($container->get($class));
        }

        return $application;
    },

    BasePathMiddleware::class => function (ContainerInterface $container) {
        return new BasePathMiddleware($container->get(App::class));
    },

    ErrorMiddleware::class => function (ContainerInterface $container): ErrorMiddleware {
        $app = $container->get(App::class);
        $config = $container->get(Configuration::class);

        $logger = null;
        if ($config->getString('error.log_file')) {
            $logger = $container->get(LoggerFactory::class)
                ->addFileHandler($config->getString('error.log_file'))
                ->createLogger();
        }

        $errorMiddleware = new ErrorMiddleware(
            $app->getCallableResolver(),
            $app->getResponseFactory(),
            (bool) $config->getString('error.display_error_details'),
            (bool) $config->getString('error.log_errors'),
            (bool) $config->getString('error.log_error_details'),
            $logger
        );

        // Set the Not Found Error
        $errorMiddleware->setErrorHandler(HttpNotFoundException::class, NotFoundHandler::class);

        return $errorMiddleware;
    },

    LoggerFactory::class => function (ContainerInterface $container): LoggerFactory {
        $config = $container->get(Configuration::class);

        return new LoggerFactory($config->getArray('logger'));
    },
];
