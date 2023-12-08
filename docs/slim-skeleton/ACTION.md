# Slim-Skeleton

Put your actions here.

## Example 1: Simple message "Hello World" as string
We get a simple message "Hello World" in our Webbrowser. Copy this code in a src/Action/Home/HomeAction.php file.
```php
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
```
Create a new route in routes/web.php
```php

return function(App $app)
{
    $app->get('/', \App\Action\Home\HomeAction::class);
}

```
Now start a terminal and go to this slim project. Type **composer start** and start the php native webserver. Type in your browser urlbar **localhost:8080** and see your message.

___

## Example 2: Simple message "Hello World" as Json
We get a simple JSON-Data "Hello World" in our Webbrowser. Copy this code in a src/Action/Home/HomeAction.php file.
```php
<?php

declare(strict_types=1);

namespace App\Action\Home;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class IndexAction
{
    public function __invoke(Request $request, Response $response, array $args = []): Response
    {
        $data = ['message' => 'Hello World!'];

        $response->getBody()->write(json_encode($data));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(StatusCodeInterface::STATUS_CREATED);
    }
}
```
Create a new route in routes/web.php or routes/api.php. For using the api routes, you must uncomment the line in bootstrap/app.php.
```php

return function(App $app)
{
    $app->get('/', \App\Action\Home\HomeAction::class);
}
```
Now start a terminal and go to this slim project. Type **composer start** and start the php native webserver. Type in your browser urlbar **localhost:8080** and see your JSON-Data.