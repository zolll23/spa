<?php

declare(strict_types=1);

namespace Spa\Domains\Comments;

use VPA\DI\Injectable;
use VPA\Framework\Collection;
use VPA\Framework\Exceptions\DBException;
use VPA\Framework\Exceptions\ValidationException;
use VPA\Framework\Validator;

#[Injectable]
class CommentService
{
    /**
     * @param CommentRepositoryInterface $repository
     * @param Validator $validator
     */
    public function __construct(
        private CommentRepositoryInterface $repository,
        private Validator $validator,
    ) {
    }

    /**
     * @return Collection
     */
    public function getCommentsForPost(): Collection
    {
        return $this->repository->getCommentsForPost();
    }

    /**
     * @param CommentDto $commentDto
     *
     * @return CommentDto
     * @throws DBException
     */
    public function addCommentToPost(CommentDto $commentDto): CommentDto
    {
        $rules = [
            'userName' => ['required'],
            'userEmail' => ['required','email'],
            'title' => ['required'],
            'content' => ['required'],
        ];
        $invalid = $this->validator->validate($commentDto, $rules);
        if ($invalid) {
            throw new ValidationException($this->validator->errorsAsString());
        }
        return $this->repository->addCommentToPost($commentDto);
    }
}
