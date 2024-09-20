<?php

declare(strict_types=1);

namespace App\Factory;

use Psr\Log\LoggerInterface;

interface LoggerFactoryInterface
{
    public function addFileHandler(string $filename): self;
    public function createLogger(): LoggerInterface;
}
