<?php
$FACTORY_DIR = '\Lulu\Imageboard\Application\MongoApplication\Factory';

return [
    'Router' => $FACTORY_DIR.'\RouterFactory',
    'MongoClient' => $FACTORY_DIR.'\Mongo\MongoClientFactory',
    'MongoDB' => $FACTORY_DIR.'\Mongo\MongoDBFactory',
    'BoardRepository' => $FACTORY_DIR.'\Repository\BoardRepositoryFactory',
    'PostRepository' => $FACTORY_DIR.'\Repository\PostRepositoryFactory',
    'ThreadRepository' => $FACTORY_DIR.'\Repository\ThreadRepositoryFactory',
];