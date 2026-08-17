<?php

error_reporting(0);
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');

// List of Supported Timezones
// see, https://www.php.net/manual/en/timezones.php
date_default_timezone_set('Europe/Berlin');

$settings = [];

$settings['commands'] = [
    \App\Console\ExampleCommand::class,
    // Add more here ...
];

// Error handler
$settings['error'] = [
    'display_error_details' => false,

    'log_errors' => true,

    'log_error_details' => true,

    'log_file' => 'error.log',
];

$settings['logger'] = [
    'name' => 'app',
    'path' => __DIR__ . '/../var/logs/',
    'filename' => 'app.log',
    'level' => \Monolog\Level::Debug,
    'file_permission' => 0775,
];

$settings['db'] = [];

return $settings;
