<?php
$FACTORY_DIR = '\Lulu\Imageboard\Factory';

return [
    'factories' => [
        'Router' => $FACTORY_DIR.'\RouterFactory',
        'BoardRESTService' => $FACTORY_DIR.'\Service\REST\BoardRESTServiceFactory',
        'PostRESTService' => $FACTORY_DIR.'\Service\REST\PostRESTServiceFactory',
        'ThreadFeedRESTService' => $FACTORY_DIR.'\Service\REST\ThreadFeedRESTServiceFactory',
        'ThreadRESTService' => $FACTORY_DIR.'\Service\REST\ThreadRESTServiceFactory',
        'Controller\Board\IndexController' => $FACTORY_DIR.'\Controller\Board\IndexControllerFactory',
        'Controller\Thread\IndexController' => $FACTORY_DIR.'\Controller\Thread\IndexControllerFactory',
        'Controller\Thread\FeedController' => $FACTORY_DIR.'\Controller\Thread\FeedControllerFactory',
        'Controller\Post\IndexController' => $FACTORY_DIR.'\Controller\Post\IndexControllerFactory',
    ]
];