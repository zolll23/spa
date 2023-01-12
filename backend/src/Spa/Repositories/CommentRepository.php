<?php

declare(strict_types=1);

namespace Spa\Repositories;

use Spa\Domains\Comments\CommentDto;
use Spa\Domains\Comments\CommentEntity;
use Spa\Domains\Comments\CommentRepositoryInterface;
use VPA\Framework\Collection;
use VPA\Framework\Exceptions\DBException;

class CommentRepository implements CommentRepositoryInterface
{

    public function __construct(private CommentEntity $entity)
    {
    }

    /**
     * @inheritDoc
     */
    public function getCommentsForPost(): Collection
    {
        return $this->entity->find()->orderBy(['created_at desc'])->get();
    }

    /**
     * @param CommentDto $commentDto
     *
     * @return CommentDto
     * @throws DBException
     */
    public function addCommentToPost(CommentDto $commentDto): CommentDto
    {
        $entity = $this->entity->new();
        $entity->user_name = $commentDto->userName;
        $entity->email = $commentDto->userEmail;
        $entity->title = $commentDto->title;
        $entity->content = $commentDto->content;
        $comment = $entity->insert();
        $castedEntity = [
            'id' => $comment['id'],
            'userName' => $comment['user_name'],
            'userEmail' => $comment['email'],
            'title' => $comment['title'],
            'content' => $comment['content'],
            'createdAt' => $comment['created_at'],
        ];
        return new CommentDto($castedEntity);
    }
}
