<?php

declare(strict_types=1);

use Slim\App;

/*
 *----------------------------------------------------------------------------
 * Slim middleware
 *----------------------------------------------------------------------------
 *
 * You can run code before and after your Slim application to manipulate the
 * Request and Response objects as you see fit. This is called middleware.
 * Why would you want to do this?
 * Perhaps you want to protect your app from cross-site request forgery.
 * Maybe you want to authenticate requests before your app runs.
 * Middleware is perfect for these scenarios.
 *
 * For more informations see:
 * https://www.slimframework.com/docs/v4/concepts/middleware.html
 *
 */
return function (App $app) {
    /*
     *----------------------------------------------------------------------------
     * Parse json, form data and xml
     *----------------------------------------------------------------------------
     *
     */
    $app->addBodyParsingMiddleware();

    /*
     *----------------------------------------------------------------------------
     * Add the Slim built-in routing middleware
     *----------------------------------------------------------------------------
     */
    $app->addRoutingMiddleware();

    /*
     *----------------------------------------------------------------------------
     * Catch exceptions and errors
     *----------------------------------------------------------------------------
     */
    $app->addErrorMiddleware(true, true, true);
};
