<?php

declare(strict_types=1);

namespace App\Domain\Home\Data;

use App\Domain\Home\Data\Message;
use ArrayIterator;
use IteratorAggregate;
use Traversable;

/**
 * @implements IteratorAggregate<int, Message>
 */
final class MessageCollection implements IteratorAggregate
{
    /**
     * @var list<Message>
     */
    private array $list = [];

    /**
     * Add a new Message to collection.
     *
     * @param Message $message The message.
     */
    public function add(Message $message): void
    {
        $this->list[] = $message;
    }

    /**
     * Iterate over this collection.
     *
     * @return Traversable<int, Message>
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->list);
    }
}
