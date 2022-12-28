<?php

return function (array $settings): array {
    $settings['error']['display_error_details'] = true;
    $settings['error']['log_errors'] = true;

    // Database
    $settings['db']['database'] = 'slim_skeleton_test';

    // Mocked Logger settings
    $settings['logger'] = [
        'test' => new \Monolog\Logger('test', [
            new \Monolog\Handler\TestHandler(),
            // new \Monolog\Handler\StreamHandler('php://output', \Monolog\Level::Warning),
        ]),
    ];

    return $settings;
};
