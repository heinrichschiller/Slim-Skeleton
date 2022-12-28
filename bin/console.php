<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;

require_once __DIR__ . '/../vendor/autoload.php';

$container = (require __DIR__ . '/../bootstrap/app.php')->getContainer();

$app = $container->get(Application::class);
$app->run();
