# Slim-Skeleton

Put your actions here.

## Example 1: Simple message "Hello World" as string
We get a simple message "Hello World" in our Webbrowser. Copy this code in a src/Action/IndexAction.php file.
```php
<?php

declare( strict_types = 1 );

namespace App\Action;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class IndexAction
{
    public function __invoke(Request $request, Response $response, array $args = []): Response
    {
        $response->getBody()->write('Hello World');

        return $response;
    }
}
```
Create a new route in routes/web.php
```php
<?php

declare( strict_types = 1 );

use Slim\App;

return function(App $app)
{
    $app->get('/', \App\Action\IndexAction::class);
}
```
Now start a terminal and go to this slim project. Type **composer serve** and start the php native webserver. Type in your browser urlbar **localhost:8080** and see your message.

___

## Example 2: Simple message "Hello World" as Json
We get a simple JSON-Data "Hello World" in our Webbrowser. Copy this code in a src/Action/IndexAction.php file.
```php
<?php

declare( strict_types = 1 );

namespace App\Action;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class IndexAction
{
    public function __invoke(Request $request, Response $response, array $args = []): Response
    {
        $data = ['message' => 'Welcome to Slim PHP micro framework!'];

        $response->getBody()->write(json_encode($data));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
```
Create a new route in routes/web.php or routes/api.php. For using the api routes, you must uncomment the line in bootstrap/app.php.
```php
<?php

declare( strict_types = 1 );

use Slim\App;

return function(App $app)
{
    $app->get('/', \App\Action\IndexAction::class);
}
```
Now start a terminal and go to this slim project. Type **composer serve** and start the php native webserver. Type in your browser urlbar **localhost:8080** and see your JSON-Data.