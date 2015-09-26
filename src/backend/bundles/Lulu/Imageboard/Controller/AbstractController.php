<?php
namespace Lulu\Imageboard\Controller;

use Symfony\Component\HttpFoundation\Request;

abstract class AbstractController
{
    /**
     * Request
     * @var Request
     */
    private $request;

    /**
     * Router args
     * @var array
     */
    private $args = [];

    /**
     * Setup controller
     * @param Request $request
     * @param array $args
     */
    public function setup(Request $request, array $args)
    {
        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
            $data = json_decode($request->getContent(), true);
            $request->request->replace(is_array($data) ? $data : array());
        }

        $this->request = $request;
        $this->args = $args;
    }

    /**
     * Returns request
     * @return Request
     */
    public function getRequest() {
        return $this->request;
    }

    /**
     * Returns args
     * @return array
     */
    public function getArgs() {
        return $this->args;
    }
}