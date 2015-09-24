<?php
namespace Lulu\Imageboard\Application\MongoApplication\Factory\Repository;

use Lulu\Imageboard\Application\MongoApplication\Repository\PostRepository;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class PostRepositoryFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        /** @var \MongoDB $mongoDB */
        $mongoDB = $serviceManager->get('MongoDB');

        return new PostRepository($mongoDB->selectCollection('posts'));
    }
}