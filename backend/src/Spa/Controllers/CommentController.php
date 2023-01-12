<?php

declare(strict_types=1);

namespace Spa\Controllers;

use HttpSoft\Response\JsonResponse;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Spa\Domains\Comments\CommentDto;
use Spa\Domains\Comments\CommentService;
use VPA\Framework\Attributes\Get;
use VPA\Framework\Attributes\Post;
use VPA\Framework\Controllers\Controller;
use VPA\Framework\Exceptions\ControllerException;
use VPA\Framework\Router;

class CommentController extends Controller
{
    /**
     * @param Router $router
     * @param CommentService $comments
     * @throws ControllerException
     */
    public function __construct(protected Router $router, private CommentService $comments)
    {
        parent::__construct($router);
    }

    /**
     * Получает список комментариев и отдает их клиенту
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    #[Get(path: '/api/v1/post/comments')]
    public function listComments(RequestInterface $request): ResponseInterface
    {
        try {
            $comments = $this->comments->getCommentsForPost();
            return new JsonResponse($comments->getAsArray());
        } catch (\Throwable $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Получает данные о новом комментарии от клиента и сохраняет его
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    #[Post(path: '/api/v1/post/comment/add')]
    public function addComment(RequestInterface $request): ResponseInterface
    {
        $commentInfo = json_decode($request->getBody()->getContents(), true);
        if (!is_array($commentInfo)) {
            return new JsonResponse(['error' => 'Invalid input data format'], 500);
        }
        try {
            $commentDto = new CommentDto($commentInfo);
            $savedCommentDto = $this->comments->addCommentToPost($commentDto);
            return new JsonResponse($savedCommentDto);
        } catch (\Throwable $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }
}
