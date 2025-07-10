<?php

declare(strict_types=1);

namespace App\Domain\Home\Data;

/**
 * Message
 *
 * Or something like that ...
 */
final class Message
{
    /**
     * The constructor.
     *
     * @param string $message A message.
     */
    public function __construct(
        private string $message = '',
    ) {
        $this->setMessage($message);
    }

    /**
     * Get a message.
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Set a message.
     *
     * @param string $message A message.
     *
     * @return void
     */
    private function setMessage(string $message): void
    {
        $this->message = $message;
    }
}
