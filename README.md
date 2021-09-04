# Slim-Skeleton

[![Coverage Status](https://coveralls.io/repos/github/heinrichschiller/Slim-Skeleton/badge.svg?branch=main)](https://coveralls.io/github/heinrichschiller/Slim-Skeleton?branch=main)
[![Build Status](https://travis-ci.com/heinrichschiller/Slim-Skeleton.svg?branch=main)](https://travis-ci.com/github/heinrichschiller/Slim-Skeleton)
[![Latest Stable Version](https://poser.pugx.org/heinrichschiller/slim-skeleton/v)](//packagist.org/packages/heinrichschiller/slim-skeleton)
[![Latest Unstable Version](https://poser.pugx.org/heinrichschiller/slim-skeleton/v/unstable)](//packagist.org/packages/heinrichschiller/slim-skeleton)
[![License](https://poser.pugx.org/heinrichschiller/slim-skeleton/license)](//packagist.org/packages/heinrichschiller/slim-skeleton)

My own (non official) simple slim skeleton app, for websites, apis and webapps. It is not better than the official Slim-Skeleton, it is more a composer package and has my own configuration for my work with Slim. If you don't know what to take, take the original :)

See below:

## Slim-Framework Mainpage

https://www.slimframework.com

## Slim-Documentation

https://www.slimframework.com/docs/v4/

## Slim-Framework GitHub

https://github.com/slimphp

## Official Slim-Skeleton

https://github.com/slimphp/Slim-Skeleton

## Install

composer create-project heinrichschiller/slim-skeleton [my-app-name] --prefer-dist

## Usage

After installing the skeleton-app, please go to bootstrap/app.php and include one or both routes that is needed.

```php

// bootstrap.app.php

...

/*
|----------------------------------------------------------------------------
| Set up routes with nikic/fast-route
|----------------------------------------------------------------------------
|
| For more informations see:
| https://www.slimframework.com/docs/v4/objects/routing.html
|
| Include the routes that you need. You can use web-routes for classic php
| applications or api-routes for REST-API applications. And of course you
| can use both.
|
*/

// (require ROOT_DIR . 'routes/api.php')($app);

// (require ROOT_DIR . 'routes/web.php')($app);


```

## Requirements

- PHP 7.3+ or 8.0+
- Apache with mod_rewrite

## Features

This Skeleton is based on:

- https://github.com/slimphp/Slim-Skeleton
- https://odan.github.io/2019/11/05/slim4-tutorial.html
- Autoloading with Composer
- Monolog
- PHP-DI

## Developer tools

- phpunit/phpunit
- phpstan/phpstan
- symfony/var-dumper
