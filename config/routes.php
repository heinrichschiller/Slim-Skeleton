<?php

declare(strict_types=1);

use Slim\App;

return function (App $app) {
    $app->get('/', \App\Action\Home\HomeAction::class);
};
