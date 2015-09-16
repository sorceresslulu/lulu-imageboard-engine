<?php
define('LULU_IMAGEBOARD_BACKEND_DIR', __DIR__.'/../../backend');

/** @var \Lulu\Imageboard\Bootstrap\BootstrapInterface $bootstrap */
$bootstrap = require_once LULU_IMAGEBOARD_BACKEND_DIR.'/bootstrap/mongo-bootstrap.php';

$frontController = new \Lulu\Imageboard\FrontController($bootstrap->getServiceManager());

try {
    $response = $frontController->dispatch(\Symfony\Component\HttpFoundation\Request::createFromGlobals());
}catch(\League\Route\Http\Exception\NotFoundException $e) {
    $response = new \Symfony\Component\HttpFoundation\JsonResponse([
        'message' => 'Not Found',
        'status_code' => \Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND
    ], \Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND);
}

$response->send();