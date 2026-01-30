<?php

declare(strict_types=1);

namespace App\Middleware;

use Fig\Http\Message\StatusCodeInterface;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Slim\Routing\RouteContext;

/**
 * Example middleware for validating a route parameter in Slim.
 *
 * This middleware checks a route parameter (default: "id").
 * If the parameter contains only numeric characters, the request
 * is passed to the next middleware or action.
 *
 * If the parameter contains invalid characters (e.g. letters),
 * a "400 Bad Request" response is returned.
 */
final class ValidateIdParamMiddleware implements MiddlewareInterface
{
    /**
     * The constructor.
     * 
     * @param string $paramName Name of the route parameter to validate.
     */
    public function __construct(
        private readonly string $paramName = 'id',
    )
    {}

    /**
     * Process an incoming server request.
     * 
     * @param Request $request Representation of an incoming, server-side HTTP request.
     * @param Handler $handler Handles a server request and produces a response.
     * 
     * @return Response Representation of an outgoing, server-side response.
     */
    public function process(Request $request, Handler $handler): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $route = $routeContext->getRoute();

        if ($route === null) {
            return $handler->handle($request);
        }

        $args = $route->getArguments();

        if (!array_key_exists($this->paramName, $args)) {
            return $handler->handle($request);
        }
        
        $raw = $args[$this->paramName];

        if (!$this->isValidId($raw)) {
            return $this->badRequestResponse();
        }

        $id = (int) $raw;

        $request = $request->withAttribute('route.id', $id);

        return $handler->handle($request);
    }

    /**
     * Check whether the given value is a valid numeric ID.
     *
     * The value must contain digits only.
     *
     * @param string $raw Raw route parameter value.
     */
    private function isValidId(string $raw): bool
    {
        $isValid = false;

        if(preg_match('/^\d+$/', $raw) === 1) {
            $isValid = true;
        }

        return $isValid;
    }

    /**
     * Create a "400 Bad Request" response.
     * 
     * @return Response
     */
    private function badRequestResponse(): Response
    {
        $response = (new Psr17Factory)
            ->createResponse(StatusCodeInterface::STATUS_BAD_REQUEST)
            ->withHeader('Content-Type', 'text/plain');
        
        $response->getBody()->write('Bad request: invalid id');

        return $response;
    }
}
