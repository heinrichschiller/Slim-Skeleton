<?php

declare(strict_types=1);

namespace App\Action\Home;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class HomeAction
{
    public function __invoke(Request $request, Response $response, array $args = []): Response
    {
        $response->getBody()->write('Hello World!');

        return $response;
    }
}