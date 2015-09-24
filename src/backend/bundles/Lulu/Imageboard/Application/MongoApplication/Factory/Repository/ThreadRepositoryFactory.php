<?php
namespace Lulu\Imageboard\Application\MongoApplication\Factory\Repository;

use Lulu\Imageboard\Application\MongoApplication\Repository\ThreadRepository;
use Lulu\Imageboard\Domain\Post\PostRepositoryInterface;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class ThreadRepositoryFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        /** @var \MongoDB $mongoDB */
        $mongoDB = $serviceManager->get('MongoDB');
        /** @var PostRepositoryInterface $postRepository */
        $postRepository = $serviceManager->get('PostRepository');

        return new ThreadRepository($mongoDB->selectCollection('threads'), $postRepository);
    }
}