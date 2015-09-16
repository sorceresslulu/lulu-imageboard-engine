<?php
return [
    'zend_service_manager' => [
        'factories' => [
            'Lulu\Imageboard\Router' => 'Lulu\Imageboard\Factory\RouterFactory',
            'Lulu\Imageboard\REST\Board\BoardRESTService' => 'Lulu\Imageboard\Factory\REST\Board\BoardRESTServiceFactory'
        ]
    ]
];