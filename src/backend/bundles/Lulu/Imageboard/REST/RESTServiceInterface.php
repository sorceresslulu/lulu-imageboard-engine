<?php
namespace Lulu\Imageboard\REST;

use League\Route\RouteCollection;

interface RESTServiceInterface
{
    public function initRoutes(RouteCollection $routes);
}