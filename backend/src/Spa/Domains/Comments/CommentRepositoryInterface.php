<?php

declare(strict_types=1);

namespace Spa\Domains\Comments;

use VPA\DI\Injectable;
use VPA\Framework\Collection;

#[Injectable]
interface CommentRepositoryInterface
{
    /**
     * Возвращает все комментарии для данного поста
     *
     * @return Collection
     */
    public function getCommentsForPost(): Collection;
}