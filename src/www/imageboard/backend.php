<?php
use Lulu\Imageboard\Application\MongoApplication\MongoApplication;
use Lulu\Imageboard\ServiceManager\ServiceManager;

define('LULU_IMAGEBOARD_BACKEND_DIR', __DIR__.'/../../backend');
define('LULU_IMAGEBOARD_CONFIGURATION_DIR', LULU_IMAGEBOARD_BACKEND_DIR.'/config');
define('LULU_IMAGEBOARD_BUNDLE_DIR', LULU_IMAGEBOARD_BACKEND_DIR.'/bundles/Lulu/Imageboard');
define('LULU_IMAGEBOARD_VENDOR', LULU_IMAGEBOARD_BACKEND_DIR.'/vendor');

require_once LULU_IMAGEBOARD_VENDOR.'/autoload.php';
require_once LULU_IMAGEBOARD_BUNDLE_DIR.'/Bootstrap/Psr4AutoloaderClass.php';

$autoLoader = new \Lulu\Imageboard\Bootstrap\Psr4AutoloaderClass();
$autoLoader->addNamespace('Lulu\Imageboard', LULU_IMAGEBOARD_BUNDLE_DIR);
$autoLoader->register();

$configuration = array_merge_recursive(
    require LULU_IMAGEBOARD_CONFIGURATION_DIR.'/configuration.php',
    require LULU_IMAGEBOARD_CONFIGURATION_DIR.'/factories.php'
);

$application = new MongoApplication(
    new ServiceManager(),
    $configuration
);

$application->bootstrap();
$application->run();