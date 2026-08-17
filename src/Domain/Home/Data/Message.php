<?php

declare(strict_types=1);

namespace App\Domain\Home\Data;

/**
 * Message
 */
final class Message
{
    public function __construct(
        private int $id = 0,
        private string $message = '',
    ) {
        $this->setMessage($message);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    private function setMessage(string $message): void
    {
        $this->message = $message;
    }
}
