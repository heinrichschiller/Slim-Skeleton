<?php

declare(strict_types=1);

use Selective\BasePath\BasePathMiddleware;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;

return function (App $app) {
    
    $app->addBodyParsingMiddleware();

    $app->addRoutingMiddleware();

    $app->add(BasePathMiddleware::class);

    $app->add(ErrorMiddleware::class);
};
