<?php

namespace Spa\Domains\Comments;

use VPA\Framework\Dto;

class CommentDto extends Dto
{
    public ?int $id = null;
    public string $userName;
    public string $userEmail;
    public string $title;
    public string $content;
    public ?string $createdAt;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        $this->userName = $data['userName'];
        $this->userEmail = $data['userEmail'];
        $this->title = $data['title'];
        $this->content = $data['content'];
        if (isset($data['createdAt'])) {
            $this->createdAt = $data['createdAt'];
        }
    }
}
