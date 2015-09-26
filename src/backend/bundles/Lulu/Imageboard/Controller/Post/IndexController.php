<?php
namespace Lulu\Imageboard\Controller\Post;

use Lulu\Imageboard\Controller\AbstractController;
use Lulu\Imageboard\Service\REST\PostRESTService;

class IndexController extends AbstractController
{
    /**
     * Post REST Service
     * @var PostRESTService
     */
    private $postRESTService;

    /**
     * IndexController constructor.
     * @param PostRESTService $postRESTService
     */
    public function __construct(PostRESTService $postRESTService) {
        $this->postRESTService = $postRESTService;
    }
}