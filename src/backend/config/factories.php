<?php
return call_user_func(function() {
    $FACTORY_DIR = '\Lulu\Imageboard\Factory';

    return [
        'factories' => [
            'Router' => $FACTORY_DIR.'\RouterFactory',
            'BoardRESTService' => $FACTORY_DIR.'\Service\REST\BoardRESTServiceFactory',
            'PostRESTService' => $FACTORY_DIR.'\Service\REST\PostRESTServiceFactory',
            'ThreadRESTService' => $FACTORY_DIR.'\Service\REST\ThreadRESTServiceFactory',
            'ThreadFeedRESTService' => $FACTORY_DIR.'\Service\REST\Thread\ThreadFeedRESTServiceFactory',
            'ThreadReplyRESTService' => $FACTORY_DIR.'\Service\REST\Thread\ThreadReplyRESTServiceFactory',
            'Controller\Board\IndexController' => $FACTORY_DIR.'\Controller\Board\IndexControllerFactory',
            'Controller\Thread\IndexController' => $FACTORY_DIR.'\Controller\Thread\IndexControllerFactory',
            'Controller\Thread\FeedController' => $FACTORY_DIR.'\Controller\Thread\FeedControllerFactory',
            'Controller\Thread\ReplyController' => $FACTORY_DIR.'\Controller\Thread\ReplyControllerFactory',
            'Controller\Post\IndexController' => $FACTORY_DIR.'\Controller\Post\IndexControllerFactory',
            'ThreadReplyService' => $FACTORY_DIR.'\Service\Thread\ThreadReplyServiceFactory',
        ]
    ];
});