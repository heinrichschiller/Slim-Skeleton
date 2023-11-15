<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$env = (new ArgvInput())->getParameterOption(['--env', 'e'], 'dev');

if ($env) {
    $_ENV['APP_ENV'] = $env;
}

/**
 * @var ContainerInterface $container
 */
$container = (require __DIR__ . '/../config/bootstrap.php')->getContainer();

try {
    /**
     * @var Application $application
     */
    $application = $container->get(Application::class);
    exit($application->run());
} catch (Throwable $exception) {
    echo $exception->getMessage();
    exit(1);
}
