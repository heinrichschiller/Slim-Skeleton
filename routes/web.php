<?php

/**
 * MIT License
 *
 * Copyright (c) 2020 - 2021 Heinrich Schiller
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 */

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
        $html = <<<HTML
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>heinrichs Slim4-Skeleton</title>

                <link 
                    href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" 
                    rel="stylesheet" 
                    integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" 
                    crossorigin="anonymous"
                >

                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">

                <style>
                    body {
                        background-color: #282a36;
                    }

                    section {
                        margin-top: 3rem;
                    }

                    .card {
                        background-color: #1c2035;
                        color: #aaa;
                    }

                    .site-title {
                        text-align: center; 
                        margin-top: 10rem;
                        font-family: 'Roboto', sans-serif;
                        font-size: 72px;
                        color: #719E40;
                    }

                    .site-slogan {
                        color: #aaa;
                        text-align: center;
                        font-size: 24px;
                    }
                </style>
            </head>
            <body>
                <header>
                    <div class="site-title">
                        heinrichs Slim4-Skeleton
                    </div>
                    <div class="site-slogan">
                        Welcome to Slim PHP micro framework!
                    </div>
                </header>

                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Official Project</h5>
                                        <div class="card-text">
                                            <ul>
                                                <li>
                                                    <strong>Homepage: </strong>
                                                    <a href="https://www.slimframework.com" target="_blank" rel="noopener">slimframework.com</a>
                                                </li>
                                                <li>
                                                    <strong>Documentation: </strong>
                                                    <a href="https://www.slimframework.com/docs/v4/" target="_blank" rel="noopener">slimframework.com/docs</a>
                                                </li>
                                                <li>
                                                    <strong>Forum: </strong>
                                                    <a href="https://discourse.slimframework.com/" target="_blank" rel="noopener">discourse.slimframework.com</a>
                                                </li>
                                                <li>
                                                    <strong>Skeleton: </strong>
                                                    <a href="https://github.com/slimphp/Slim-Skeleton" target="_blank" rel="noopener">Slim-Skeleton</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Features</h5>
                                        <div class="card-text">
                                            <ul>
                                                <li>
                                                    <strong>PHP-DI: </strong>
                                                    <a href="https://php-di.org/" target="_blank" rel="noopener">php-di.org</a>
                                                </li>
                                                <li>
                                                    <strong>PHP dotenv: </strong>
                                                    <a href="https://github.com/vlucas/phpdotenv" target="_blank" rel="noopener">vlucas/phpdotenv</a>
                                                </li>
                                                <li>
                                                    <strong>Monolog: </strong>
                                                    <a href="https://github.com/Seldaek/monolog" target="_blank" rel="noopener">monolog/monolog</a>
                                                </li>
                                                <li>
                                                    <strong>Symfony Console: </strong>
                                                    <a href="https://symfony.com/doc/current/components/console.html" target="_blank" rel="noopener">symfony/console</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <script 
                    src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" 
                    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" 
                    crossorigin="anonymous"
                ></script>
            </body>
            </html>
        HTML;

        $response->getBody()->write($html);

        return $response;
    });
};