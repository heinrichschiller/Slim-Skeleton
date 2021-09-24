<?php

/**
 * MIT License
 *
 * Copyright (c) 2020 - 2021 Heinrich Schiller
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 */

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
use Symfony\Component\Console\INput\InputOption;

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