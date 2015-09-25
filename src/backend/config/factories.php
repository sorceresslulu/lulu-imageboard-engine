<?php
$FACTORY_DIR = '\Lulu\Imageboard\Factory';

return [
    'factories' => [
        'BoardRESTService' => $FACTORY_DIR.'\REST\BoardRESTServiceFactory',
        'PostRESTService' => $FACTORY_DIR.'\REST\PostRESTServiceFactory',
        'ThreadFeedRESTService' => $FACTORY_DIR.'\REST\ThreadFeedRESTServiceFactory',
        'ThreadRESTService' => $FACTORY_DIR.'\REST\ThreadRESTServiceFactory',
    ]
];