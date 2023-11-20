<?php

declare(strict_types=1);

namespace App\Handler;

use Fig\Http\Message\StatusCodeInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface;
use Slim\Interfaces\ErrorHandlerInterface;
use Throwable;

final class NotFoundHandler implements ErrorHandlerInterface
{
    /**
     * The invoker.
     *
     * @param Request $request
     * @param Throwable $exception
     * @param bool $displayErrorDetails
     * @param bool $logErrors
     * @param bool $logErrorDetails
     *
     * @return ResponseInterface
     */
    public function __invoke(
        Request $request,
        Throwable $exception,
        bool $displayErrorDetails,
        bool $logErrors,
        bool $logErrorDetails
    ): ResponseInterface {
        $response = new Response();
        $response->getBody()->write('<h1>404 Not Found</h1>');

        return $response->withStatus(StatusCodeInterface::STATUS_NOT_FOUND);
    }
}
