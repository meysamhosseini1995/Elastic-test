<?php

return [

    'default' => env('SEARCHENGIN_CONNECTION', 'elastic'),


    'driver' => [

        'elastic' => [
            'hosts'               => [
                env('ELASTIC_HOST', 'localhost:9200'),
            ],

            // configure basic authentication
            'basicAuthentication' => [
                "username" => env('ELASTIC_USERNAME'),
                "password" => env('ELASTIC_PASSWORD'),
            ],
            // configure HTTP client (Guzzle by default)
            'httpClientOptions'   => [
                'timeout' => 2,
            ],
        ],

    ],


];

