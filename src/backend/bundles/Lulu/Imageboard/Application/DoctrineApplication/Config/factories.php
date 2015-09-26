<?php
$FACTORY_PREFIX = '\Lulu\Imageboard\Application\DoctrineApplication\Factory';

return [
    'EntityManager' => $FACTORY_PREFIX.'\Doctrine\EntityManagerFactory',
    'BoardRepository' => $FACTORY_PREFIX.'\Domain\Repository\BoardRepositoryFactory',
    'PostRepository' => $FACTORY_PREFIX.'\Domain\Repository\PostRepositoryFactory',
    'ThreadRepository' => $FACTORY_PREFIX.'\Domain\Repository\ThreadRepositoryFactory',
];