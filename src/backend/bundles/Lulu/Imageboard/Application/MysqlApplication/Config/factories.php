<?php
$FACTORY_PREFIX = '\Lulu\Imageboard\Application\MysqlApplication\Factory';

return [
    'Mysqli' => $FACTORY_PREFIX.'\MysqliFactory',
    'BoardRepository' => $FACTORY_PREFIX.'\Domain\Entity\BoardRepositoryFactory',
    'PostRepository' => $FACTORY_PREFIX.'\Domain\Entity\PostRepositoryFactory',
    'ThreadRepository' => $FACTORY_PREFIX.'\Domain\Entity\ThreadRepositoryFactory',
];