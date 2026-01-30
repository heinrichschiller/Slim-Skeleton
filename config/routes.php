<?php

declare(strict_types=1);

use App\Middleware\ValidateIdParamMiddleware;
use Slim\App;

return function (App $app) {
    $app->get('/', \App\Action\Home\HomeAction::class);
    $app->get('/message[/{id}]', \App\Action\Home\HomeAction::class)
        ->add(new ValidateIdParamMiddleware(paramName: 'id'));
};
