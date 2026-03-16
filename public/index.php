<?php

declare(strict_types=1);

if (PHP_VERSION_ID < 80400) {
    $message = 'This Slim-Skeleton is supported from PHP 8.4.0 or higher. Installed PHP version is: ' . PHP_VERSION;

    if (PHP_SAPI === 'cli') {
        fwrite(STDERR, $message . PHP_EOL);
        exit(1);
    }

    exit($message);
}

(require_once __DIR__ . '/../config/bootstrap.php')->run();
