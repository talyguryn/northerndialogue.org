<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => PROJECT_ROOT . 'templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => PROJECT_ROOT . 'logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Hawk catcher settings
        'hawk' => [
            'name' => 'hawk-catcher',
            'token' => $_ENV['HAWK_TOKEN'],
            'level' => \Monolog\Logger::DEBUG,
            'path' => PROJECT_ROOT . 'logs/hawk.log',
        ],

        'lang' => [
            'default' => $_ENV['LANG'],
            'available' => [
                'en',
                'fr',
                'ru',
            ],
            'folder' => PROJECT_ROOT . 'lang/',
        ]
    ],
];
