<?php declare(strict_types=1);

namespace Tests\Traits;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\UriInterface;
use RuntimeException;

trait HttpTestTrait
{
    protected function createRequest(
        string $method,
        string|UriInterface $uri,
        array $serverParams = []
    ): Request {
        if (!$this->container instanceof ContainerInterface) {
            throw new RuntimeException('PHP-DI container not found.');
        }

        $factory = $this->container->get(ServerRequestFactoryInterface::class);

        return $factory->createServerRequest($method, $uri, $serverParams);
    }

    protected function createFormRequest(
        string $method,
        string|UriInterface $uri,
        array $data = null
    ): Request {
        $request = $this->createRequest($method, $uri);

        if ($data !== null) {
            $request = $request->withParsedBody($data);
        }

        return $request->withHeader('Content-Type', 'application/x-www-form-urlencoded');
    }

    protected function createResponse(
        int $status = 200,
        string $reasonPhrase = ''
    ): Response {
        if (!$this->container instanceof ContainerInterface) {
            throw new RuntimeException('PHP-DI container not found.');
        }

        $factory = $this->container->get(ResponseFactoryInterface::class);

        return $factory->createResponse($status, $reasonPhrase);
    }

    protected function assertResponseContains(
        Response $response,
        string $needle
    ): void {
        $body = (string) $response->getBody();

        $this->assertStringContainsString($needle, $body);
    }
}
