# Slim-Skeleton Factories

## LoggerFactory
For logging you can now use the supplied LoggerFactory class. An example will show you how it works.
```php
...
use App\Factory\LoggerFactory;
use Exception;
use Psr\Log\LoggerInterface;
...

public function __construct(LoggerFactory $logger)
{
    $this->logger = $logger
        ->addFileHandler('my_log.log')
        ->createLogger();
}

...

try {
    // do something ...
    $message = 'Hello World!';

    $this->logger->info(sprintf('message output: %s', $message));

} catch (Exception $exception) {
    $this->logger->error($exception->getMessage());

    throw $exception;
}
...
```

That's it.
