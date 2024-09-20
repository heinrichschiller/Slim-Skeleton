<?php declare(strict_types=1);

namespace Tests\Traits;

use Psr\Container\ContainerInterface;
use UnexpectedValueException;

trait ContainerTestTrait
{
    protected ?ContainerInterface $container;

    protected function setUpContainer(?ContainerInterface $container = null): void
    {
        if ($container instanceof ContainerInterface) {
            $this->container = $container;

            return;
        }

        throw new UnexpectedValueException('Container must be initialized.');
    }
}
