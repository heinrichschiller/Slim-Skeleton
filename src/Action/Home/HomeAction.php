<?php

declare(strict_types=1);

namespace App\Action\Home;

use App\Domain\Home\Service\MessageFinder;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * HomeAction.
 *
 * Shows the main page.
 */
final class HomeAction
{
    /**
     * @Injection
     * @var MessageFinder
     */
    private MessageFinder $messageFinder;

    /**
     * The constructor.
     *
     * @param MessageFinder $messageFinder The message finder.
     */
    public function __construct(MessageFinder $messageFinder)
    {
        $this->messageFinder = $messageFinder;
    }

    /**
     * The invoker.
     *
     * @param Request $request Representation of an incoming, server-side HTTP request.
     * @param Response $response Representation of an outgoing, server-side response.
     * @param array<string> $args Get all of the route's parsed arguments.
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response, array $args = []): Response
    {
        $id = (int) ($args['id'] ?? 0);
        $message = $this->messageFinder->findById($id);

        if ($message === null) {
            $response->getBody()->write('Message not found');

            return $response
                ->withStatus(StatusCodeInterface::STATUS_NOT_FOUND)
                ->withHeader('Content-Type', 'text/plain');
        }

        $response->getBody()->write($message->getMessage());

        return $response
            ->withStatus(StatusCodeInterface::STATUS_OK)
            ->withHeader('Content-Type', 'text/plain');
    }
}
