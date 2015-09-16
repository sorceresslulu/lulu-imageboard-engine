<?php
define('LULU_IMAGEBOARD_BACKEND_DIR', __DIR__.'/../../backend');

/** @var \Lulu\Imageboard\Bootstrap\BootstrapInterface $bootstrap */
$bootstrap = require_once LULU_IMAGEBOARD_BACKEND_DIR.'/bootstrap/mongo-bootstrap.php';