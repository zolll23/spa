<?php

declare(strict_types=1);

namespace Spa\Domains\Comments;

use VPA\Framework\Model;

class CommentEntity extends Model
{
    protected string $tableName = 'post_comments';

    public string $user_name;
    public string $email;
    public string $title;
    public string $content;
    protected string $created_at;
}