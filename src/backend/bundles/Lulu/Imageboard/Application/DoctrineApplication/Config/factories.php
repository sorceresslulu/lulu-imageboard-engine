<?php
return call_user_func(function() {
    $FACTORY_PREFIX = '\Lulu\Imageboard\Application\DoctrineApplication\Factory';

    return [
        'EntityManager' => $FACTORY_PREFIX.'\Doctrine\EntityManagerFactory',
        'Repositories' => $FACTORY_PREFIX.'\Domain\RepositoriesFactory',
        'BoardRepository' => $FACTORY_PREFIX.'\Domain\Repository\BoardRepositoryFactory',
        'PostRepository' => $FACTORY_PREFIX.'\Domain\Repository\PostRepositoryFactory',
        'ThreadRepository' => $FACTORY_PREFIX.'\Domain\Repository\ThreadRepositoryFactory',
    ];
});