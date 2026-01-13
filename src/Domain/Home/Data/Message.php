<?php

declare(strict_types=1);

namespace App\Domain\Home\Data;

/**
 * Message
 */
final class Message
{
    /**
     * The constructor.
     *
     * @param int $id Id of a message.
     * @param string $message The message.
     */
    public function __construct(
        private int $id = 0,
        private string $message = '',
    ) {
        $this->setMessage($message);
    }

    /**
     * Get the id of a message.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
