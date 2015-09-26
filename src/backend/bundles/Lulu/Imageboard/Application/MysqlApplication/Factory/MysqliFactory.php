<?php
namespace Lulu\Imageboard\Application\MysqlApplication\Factory;

use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class MysqliFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        /** @var array $configuration */
        $configuration = $serviceManager->get('MysqlConfiguration');

        $host = isset($configuration['host']) ? $configuration['host'] : null;
        $port = isset($configuration['port']) ? $configuration['port'] : 3306;
        $user = isset($configuration['user']) ? $configuration['user'] : 'root';
        $pass = isset($configuration['pass']) ? $configuration['pass'] : null;
        $db = isset($configuration['db']) ? $configuration['db'] : null;

        $mysqliAdapter = new \mysqli($host, $user, $pass, $pass, $port);

        if($mysqliAdapter->connect_errno) {
            throw new \Exception(sprintf('Failed to connect to MySQL with params `%s`'), var_export([
                'host' => $host,
                'port' => $port,
                'user' => $user,
                'pass' => $pass,
            ], true));
        }

        if($mysqliAdapter->select_db($db) === false) {
            throw new \Exception(sprintf('Failed to use database `%s`', $db));
        }

        return $mysqliAdapter;
    }
}