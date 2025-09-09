<?php

declare(strict_types=1);

namespace Tests\Traits;

use DI\ContainerBuilder;
use Selective\TestTrait\Traits\ContainerTestTrait;
use Selective\TestTrait\Traits\HttpTestTrait;
use Slim\App;
use UnexpectedValueException;

trait AppTestTrait
{
    use ContainerTestTrait;
    use HttpTestTrait;

    protected App $app;

    protected function setUp(): void
    {
        $container = (new ContainerBuilder())
            ->addDefinitions(__DIR__ . '/../../config/container.php')
            ->build();

        if ($container === null) {
            throw new UnexpectedValueException('Container must be initialized');
        }

        $this->app = $container->get(App::class);

        $this->setUpContainer($container);
    }
}
