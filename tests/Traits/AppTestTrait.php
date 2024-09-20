<?php declare(strict_types=1);

namespace Tests\Traits;

use DI\ContainerBuilder;
use Slim\App;

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

        $this->app = $container->get(App::class);

        $this->setUpContainer($container);
    }
}
