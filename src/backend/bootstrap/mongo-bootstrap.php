<?php
define('LULU_IMAGEBOARD_CONFIGURATION_DIR', __DIR__.'/../config');
define('LULU_IMAGEBOARD_BUNDLE_DIR', __DIR__.'/../bundles/Lulu/Imageboard');
define('LULU_IMAGEBOARD_VENDOR', __DIR__.'/../vendor');

require_once LULU_IMAGEBOARD_VENDOR.'/autoload.php';
require_once LULU_IMAGEBOARD_BUNDLE_DIR.'/Bootstrap/Psr4AutoloaderClass.php';

$autoLoader = new \Lulu\Imageboard\Bootstrap\Psr4AutoloaderClass();
$autoLoader->addNamespace('Lulu\Imageboard', LULU_IMAGEBOARD_BUNDLE_DIR);
$autoLoader->register();

$configuration = array_merge_recursive(
    require LULU_IMAGEBOARD_CONFIGURATION_DIR.'/configuration.php',
    require LULU_IMAGEBOARD_CONFIGURATION_DIR.'/zend/service-manager/global.configuration.php',
    require LULU_IMAGEBOARD_CONFIGURATION_DIR.'/zend/service-manager/mongo.configuration.php'
);

$bootstrap = new \Lulu\Imageboard\Bootstrap\Bootstrap();
$bootstrap->bootstrap($configuration);

return $bootstrap;