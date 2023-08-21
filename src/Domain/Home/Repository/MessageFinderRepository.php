<?php

declare(strict_types=1);

namespace App\Domain\Home\Repository;

/**
 * Repository where a message can be found.
 */
final class MessageFinderRepository
{
    /**
     * Find a message.
     *
     * @return array
     */
    public function findMessage(): array
    {
        // Imagine it comes from the database ...
        return [
            'Hello World!',
        ];
    }
}
