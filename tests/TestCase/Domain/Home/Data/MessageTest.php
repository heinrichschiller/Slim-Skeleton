<?php

declare(strict_types=1);

namespace Tests\TestCase\Domain\Data;

use App\Domain\Home\Data\Message;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass('App\Domain\Home\Data\Message')]
class MessageTest extends TestCase
{
    public function testMessageHasInput(): void
    {
        $message = new Message('Hello World!');

        $this->assertSame('Hello World!', $message->getMessage());
    }
}
