<?php

declare(strict_types=1);

namespace App\Action\Home;

use App\Factory\LoggerFactory;
use Exception;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class HomeAction
{
    /**
     * @Injection
     * @var LoggerFactory;
     */
    private LoggerInterface $logger;

    /**
     * The constructor.
     * 
     * @param LoggerFactory $logger The LoggerFactory
     */
    public function __construct(LoggerFactory $logger)
    {
        $this->logger = $logger
            ->addFileHandler('hello_world.log')
            ->createLogger();
    }

    /**
     * The invoker
     *
     * @param Request $request Representation of an incoming, server-side HTTP request.
     * @param Response $response Representation of an outgoing, server-side response.
     * @param array<string> $args Get all of the route's parsed arguments.
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response, array $args = []): Response
    {
        try {
            $message = 'Hello World!';

            $response->getBody()->write($message);

            $this->logger->info(sprintf('message output: %s', $message));

            return $response;
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());

            throw $exception;
        }
        
    }
}
