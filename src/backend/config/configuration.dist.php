<?php
return call_user_func(function() {
    return [
        'frontend' => [
            'bootstrap' => [
                'board' => [
                    'feed' => [
                        'threadsPerPage' => 10
                    ]
                ]
            ]
        ],
        'doctrine' => [
            'connection' => [
                'driver' => 'pdo_mysql',
                'dbname' => 'mydb',
                'user' => 'user',
                'password' => 'secret',
                'host' => 'localhost',
            ]
        ]
    ];
});