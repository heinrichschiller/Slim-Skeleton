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
