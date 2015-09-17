<?php
return [
    'zend_service_manager' => [
        'factories' => [
            'Lulu\Imageboard\Adapter\Mongo\MongoClient' => 'Lulu\Imageboard\Factory\Adapter\Mongo\MongoClientFactory',
            'Lulu\Imageboard\Adapter\Mongo\MongoDB' => 'Lulu\Imageboard\Factory\Adapter\Mongo\MongoDBFactory',
            'Lulu\Imageboard\Adapter\Mongo\Collection\BoardCollection' => 'Lulu\Imageboard\Factory\Adapter\Mongo\Collection\BoardCollectionFactory',
            'Lulu\Imageboard\Adapter\Mongo\Collection\ThreadCollection' => 'Lulu\Imageboard\Factory\Adapter\Mongo\Collection\ThreadCollectionFactory',
            'Lulu\Imageboard\Adapter\Mongo\Collection\PostCollection' => 'Lulu\Imageboard\Factory\Adapter\Mongo\Collection\PostCollectionFactory',
            'Lulu\Imageboard\Domain\Board\BoardRepository' => 'Lulu\Imageboard\Factory\Repository\Mongo\BoardRepositoryFactory',
            'Lulu\Imageboard\Domain\Board\BoardRepository\BoardPrototypeFactory' => 'Lulu\Imageboard\Factory\Repository\Mongo\BoardRepository\BoardPrototypeFactoryFactory',
            'Lulu\Imageboard\Domain\Thread\ThreadRepository' => 'Lulu\Imageboard\Factory\Repository\Mongo\ThreadRepositoryFactory',
            'Lulu\Imageboard\Domain\Post\PostRepository' => 'Lulu\Imageboard\Factory\Repository\Mongo\PostRepositoryFactory',
        ]
    ]
];