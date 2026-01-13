<?php

declare(strict_types=1);

namespace App\Domain\Home\Repository;

/**
 * Repository where a message can be found.
 *
 * Imagine it comes from the database ...
 */
final class MessageFinderRepository
{
    /**
     * @var array<int, array{id:int, message:string}>
     */
    private array $items = [
        ['id' => 0, 'message' => 'Hello World!'],
        ['id' => 1, 'message' => 'Hello Slim!'],
        ['id' => 2, 'message' => 'I ♥️ Slim!'],
        ['id' => 3, 'message' => 'It works!'],
    ];

    /**
     * Find all messages.
     *
     * @return array<int, array{id:int, message:string}>
     */
    public function findAll(): array
    {
        return $this->items;
    }

    /**
     * Find a message by id.
     *
     * @param int $id
     *
     * @return string|null
     */
    public function findById(int $id): ?string
    {
        foreach ($this->items as $item) {
            if ($item['id'] === $id) {
                return $item['message'];
            }
        }

        return null;
    }
}
