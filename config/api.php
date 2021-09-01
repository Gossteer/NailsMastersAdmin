<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */
    'server_1' => [
        'post' => [
            'GetToken' => 'https://nailsmasters.gossteer.ru/api/loginadmin',
            'ApiLogout' => 'https://nailsmasters.gossteer.ru/api/logout'
        ],
        'get' => [
            'MasterIndex' => 'https://nailsmasters.gossteer.ru/api/masterindex'
        ]
    ]

];
