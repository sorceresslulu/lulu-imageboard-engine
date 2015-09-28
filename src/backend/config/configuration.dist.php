<?php
return call_user_func(function() {
    return [
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