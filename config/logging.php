<?php

return [
    'channels' => [
        'weatherapi' => [
            'driver' => 'single',
            'path' => storage_path('logs/weatherapi.log'),
            'level' => 'debug',
            'permission' => 0664,
        ],
        'error-weatherapi' => [
            'driver' => 'single',
            'path' => storage_path('logs/error-weatherapi.log'),
            'level' => 'error',
            'permission' => 0664,
        ],

    ]
];
