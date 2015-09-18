<?php
return [
    'zend_service_manager' => [
        'factories' => [
            'Lulu\Imageboard\Router' => 'Lulu\Imageboard\Factory\RouterFactory',
            'Lulu\Imageboard\REST\Board\BoardRESTService' => 'Lulu\Imageboard\Factory\REST\Board\BoardRESTServiceFactory',
            'Lulu\Imageboard\REST\Thread\ThreadRESTService' => 'Lulu\Imageboard\Factory\REST\Thread\ThreadRESTServiceFactory',
            'Lulu\Imageboard\REST\Thread\ThreadFeedRESTService' => 'Lulu\Imageboard\Factory\REST\Thread\ThreadFeedRESTServiceFactory',
            'Lulu\Imageboard\REST\Post\PostRESTService' => 'Lulu\Imageboard\Factory\REST\Post\PostRESTServiceFactory',
        ]
    ]
];