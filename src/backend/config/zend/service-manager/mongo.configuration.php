<?php
return [
    'zend_service_manager' => [
        'factories' => [
            'Lulu\Imageboard\Adapter\Mongo\MongoClient' => 'Lulu\Imageboard\Factory\Adapter\Mongo\MongoClientFactory',
            'Lulu\Imageboard\Adapter\Mongo\MongoDB' => 'Lulu\Imageboard\Factory\Adapter\Mongo\MongoDBFactory',
            'Lulu\Imageboard\Adapter\Mongo\Collection\BoardCollection' => 'Lulu\Imageboard\Factory\Adapter\Mongo\Collection\BoardCollectionFactory',
            'Lulu\Imageboard\Domain\Board\Repository' => 'Lulu\Imageboard\Factory\Repository\Mongo\BoardRepositoryFactory'
        ]
    ]
];