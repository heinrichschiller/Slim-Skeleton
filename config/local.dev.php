<?php

return function (array $settings): array {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');

    $settings['error']['display_error_details'] = true;
    $settings['logger']['level'] = \Monolog\Level::Debug;

    $settings['db']['database'] = 'slim_skeleton_dev';

    return $settings;
};
