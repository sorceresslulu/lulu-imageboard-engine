<?php
namespace Lulu\Imageboard\Service;

use League\Route\RouteCollection;

interface RESTServiceInterface
{
    public function initRoutes(RouteCollection $routes);
}