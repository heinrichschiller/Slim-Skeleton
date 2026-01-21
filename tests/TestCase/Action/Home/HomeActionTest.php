<?php

declare(strict_types=1);

namespace Tests\TestCase\Action\Home;

use App\Action\Home\HomeAction;
use App\Domain\Home\Data\Message;
use App\Domain\Home\Service\MessageFinder;
use Fig\Http\Message\StatusCodeInterface;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(HomeAction::class)]
#[UsesClass(Message::class)]
class HomeActionTest extends TestCase
{
    public function testReturns200AndMessageBodyWhenMessageIsFound(): void
    {
        $message = new Message(
            id: 0,
            message: 'Hello World!'
        );

        $messageFinder = $this->createMock(MessageFinder::class);
        $messageFinder
            ->expects($this->once())
            ->method('findById')
            ->with(0)
            ->willReturn($message);

        $action = new HomeAction($messageFinder);

        $psr17 = new Psr17Factory();
        $request = $psr17->createServerRequest('GET', '/');
        $response = $psr17->createResponse();

        $result = $action($request, $response, ['id' => 0]);

        $this->assertSame(StatusCodeInterface::STATUS_OK, $result->getStatusCode());
        $this->assertSame('text/plain', $result->getHeaderLine('Content-Type'));
        $this->assertSame('Hello World!', (string) $result->getBody());
    }

    public function testReturns404AndMessageIsMissing(): void
    {
        $messageFinder = $this->createMock(MessageFinder::class);
        $messageFinder
            ->expects($this->once())
            ->method('findById')
            ->with(0)
            ->willReturn(null);

        $action = new HomeAction($messageFinder);

        $psr17 = new Psr17Factory();
        $request = $psr17->createServerRequest('GET', '/');
        $response = $psr17->createResponse();

        $result = $action($request, $response);

        $this->assertSame(StatusCodeInterface::STATUS_NOT_FOUND, $result->getStatusCode());
        $this->assertSame('text/plain', $result->getHeaderLine('Content-Type'));
        $this->assertSame('Message not found', (string) $result->getBody());
    }
}
