<?php

declare(strict_types=1);

namespace Tests\TestCase\Domain\Home\Data;

use App\Domain\Home\Data\Message;
use App\Domain\Home\Data\MessageCollection;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(MessageCollection::class)]
final class MessageCollectionTest extends TestCase
{
    public function testAddAndIterate(): void
    {
        $collection = new MessageCollection();

        $message1 = new Message(0, 'Hello World!');
        $message2 = new Message(1, 'Hello Slim!');

        $collection->add($message1);
        $collection->add($message2);

        $items = iterator_to_array($collection);

        $this->assertCount(2, $items);
        $this->assertSame([$message1, $message2], $items);
    }
}
