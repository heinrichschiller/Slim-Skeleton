<?php

declare(strict_types=1);

namespace App\Factory;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Symfony\Component\Uid\Uuid;

final class LoggerFactory
{
    /**
     * @var string
     */
    private string $path = '';

    /**
     * @var Level
     */
    private Level $level;

    /**
     * @var array
     */
    private array $handler = [];

    /**
     * @var LoggerInterface|null
     */
    private ?LoggerInterface $testLogger = null;

    /**
     * The constructor.
     *
     * @param array $settings Logger settings.
     */
    public function __construct(array $settings)
    {
        $this->path = (string) $settings['path'];
        $this->level = $settings['level'];

        // This can be used for testing to make the Factory testable
        if (isset($settings['test'])) {
            $this->testLogger = $settings['test'];
        }
    }

    /**
     * Create Logger instance.
     *
     * @param string|null $name Logger file name
     *
     * @return LoggerInterface
     */
    public function createLogger(string|null $name = null): LoggerInterface
    {
        if ($this->testLogger) {
            return $this->testLogger;
        }

        $logger = new Logger($name ?: Uuid::v4()->toRfc4122());

        foreach ($this->handler as $handler) {
            $logger->pushHandler($handler);
        }

        $this->handler = [];

        return $logger;
    }

    /**
     * Add handler.
     *
     * @param HandlerInterface $handler Handler
     *
     * @return self
     */
    public function addHandler(HandlerInterface $handler):self
    {
        $this->handler[] = $handler;

        return $this;
    }

    /**
     * Add file handler.
     *
     * @param string $filename  Filename.
     * @param Level $level Monolog log level.
     *
     * @return self
     */
    public function addFileHandler(string $filename, Level $level = null): self
    {
        $filename = sprintf("%s/%s", $this->path, $filename);
        $rotatingFileHandler = new RotatingFileHandler($filename, 0, $level ?? $this->level, true, 0777);

        // The last "true" here tells monolog to remove empty arrays
        $rotatingFileHandler->setFormatter(new LineFormatter(null, null, false, true));

        $this->addHandler($rotatingFileHandler);

        return $this;
    }

    /**
     * Add console handler.
     *
     * @param Level $level Monolog log level
     *
     * @return self
     */
    public function addConsoleHandler(Level $level = null): self
    {
        $streamHandler = new StreamHandler('php://stdout', $level ?? $this->level);

        // The last "true" here tells monolog to remove empty arrays
        $streamHandler->setFormatter(new LineFormatter(null, null, false, true));

        $this->addHandler($streamHandler);

        return $this;
    }
}
