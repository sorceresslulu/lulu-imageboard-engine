<?php
namespace Lulu\Imageboard\Application\DoctrineApplication;

use Doctrine\ORM\EntityManager;
use Lulu\Imageboard\Application\AbstractApplication\ApplicationInterface;
use Lulu\Imageboard\Domain\Entity\Board;
use Lulu\Imageboard\Domain\Entity\Post;
use Lulu\Imageboard\Domain\Entity\Thread;

class Bootstrap
{
    /**
     * Mongo Application
     * @var ApplicationInterface
     */
    private $application;

    /**
     * Bootstrap constructor.
     * @param ApplicationInterface $application
     */
    public function __construct(ApplicationInterface $application) {
        $this->application = $application;
    }

    /**
     * Bootstrap
     */
    public function bootstrap() {
        $this->setupPHPErrorHandler();
        $this->setupConfiguration();
        $this->setupServiceManager();
        $this->setupEntityRepositories();
    }

    /**
     * Setup handler for PHP errors
     */
    private function setupPHPErrorHandler() {
        set_error_handler(function($errno, $errstr, $errfile, $errline) {
            throw new \Exception(sprintf('PHP Error [%d]: %s in file %s:%d', $errno, $errstr, $errfile, $errline));
        });
    }

    /**
     * Setup configuration
     */
    private function setupConfiguration() {
        $this->application->getServiceManager()->getInstances()->addService('DoctrineConfiguration', $this->application->getConfiguration()['doctrine']);
        $this->application->getServiceManager()->getInstances()->addService('DoctrineApplicationPath', __DIR__);
    }

    /**
     * Setup service manager
     */
    private function setupServiceManager() {
        $serviceManager = $this->application->getServiceManager();
        $factories = $this->application->getConfiguration()['factories'];

        foreach($factories as $serviceName => $serviceFactory) {
            $serviceManager->getDefinitions()->defineServiceFactory($serviceName, $serviceFactory);
        }
    }

    /**
     * Setup entity repositories
     */
    private function setupEntityRepositories() {
        /** @var EntityManager $em */
        $em = $this->application->getServiceManager()->get('EntityManager');
        $sm = $this->application->getServiceManager()->getInstances();

        $sm->addService('BoardEntitiesRepository', $em->getRepository(Board::class));
        $sm->addService('ThreadEntitiesRepository', $em->getRepository(Thread::class));
        $sm->addService('PostEntitiesRepository', $em->getRepository(Post::class));
    }
}