<?php

declare(strict_types=1);

use Slim\App;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/*
 *----------------------------------------------------------------------------
 * Set up routes with nikic/fast-route
 *----------------------------------------------------------------------------
 *
 * For more informations see: 
 * https://www.slimframework.com/docs/v4/objects/routing.html
 *
 */
return function(App $app)
{
    $app->get('/', function(Request $request, Response $response, array $args = []): Response
    {
        $data = ['message' => 'Welcome to Slim PHP micro framework!'];

        $response->getBody()->write(json_encode($data));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    });
};