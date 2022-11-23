<?php

declare(strict_types=1);

use Monolog\Logger;

return [

    /*
     *----------------------------------------------------------------------------
     * Settings for symfony console commands
     *----------------------------------------------------------------------------
     *
     * For more information, see:
     * https://symfony.com/doc/current/console.html#the-console-app-env-app-debug
     *
     */
    'commands' => [
        // add commands here
    ],

    /*
     *----------------------------------------------------------------------------
     * Settings for ErrorMiddleware
     *----------------------------------------------------------------------------
     *
     * For more information, see:
     * https://www.slimframework.com/docs/v4/middleware/error-handling.html
     *
     */
    'error' => [
        'displayErrorDetails' => $_ENV['DISPLAY_ERROR_DETAILS'],
        'logErrors' => $_ENV['LOG_ERRORS'],
        'logErrorDetails' => $_ENV['LOG_ERROR_DETAILS']
    ],

    /*
     *----------------------------------------------------------------------------
     * Settings for Monolog Logger
     *----------------------------------------------------------------------------
     *
     * For more information, see:
     * https://github.com/Seldaek/monolog
     *
     */
    'logger' => [
        'name' => $_ENV['APP_NAME'],
        'path' => ROOT_DIR . $_ENV['LOGGER_PATH'],
        'filename' => $_ENV['LOGGER_FILENAME'],
        'level' => Logger::DEBUG,
        'filePermission' => $_ENV['LOGGER_FILE_PERMISSIONS']
    ]
];
