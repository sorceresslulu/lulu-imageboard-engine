<?php
namespace Lulu\Imageboard\Service\Thread\Reply;

use Doctrine\ORM\EntityManager;
use Lulu\Imageboard\Service\Post\Attachment\Upload\UploadService;
use Lulu\Imageboard\Domain\Repository\ThreadRepositoryInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

class ThreadReplyService
{
    /**
     * Entity Manager
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Thread Repository
     * @var ThreadRepositoryInterface
     */
    private $threadRepository;

    /**
     * Upload Service
     * @var UploadService
     */
    private $uploadService;

    /**
     * ThreadReplyService constructor.
     * @param EntityManager $entityManager
     * @param ThreadRepositoryInterface $threadRepository
     * @param UploadService $uploadService
     */
    public function __construct(EntityManager $entityManager, ThreadRepositoryInterface $threadRepository, UploadService $uploadService) {
        $this->entityManager = $entityManager;
        $this->threadRepository = $threadRepository;
        $this->uploadService = $uploadService;
    }

    /**
     * Reply to thread
     * @param ThreadReplyQuery $replyQuery
     * @throws \Exception
     */
    public function reply(ThreadReplyQuery $replyQuery)
    {
        $em = $this->entityManager;
        $em->beginTransaction();

        try {
            $post = $replyQuery->getPost();
            $thread = $this->threadRepository->getThreadById($replyQuery->getThreadId());
            $thread->getPosts()->add($post);

            $uploadQuery = $this->uploadService->createQuery($replyQuery->getPost(), $replyQuery->getUploadFiles());
            $uploadQuery->validate();

            $em->persist($post);
            $em->flush();

            $post->setAttachments(array_merge_recursive($post->getAttachments(), $uploadQuery->process()));

            $em->persist($post);
            $em->flush();
            $em->commit();
        }catch(Exception $e) {
            $em->rollback();
            throw $e;
        }
    }
}