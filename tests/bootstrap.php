<?php

declare(strict_types=1);

use DG\BypassFinals;

require_once __DIR__ . '/../vendor/autoload.php';

if (PHP_SAPI === 'cli' && defined('PHPUNIT_COMPOSER_INSTALL')) {
    BypassFinals::enable();
}
