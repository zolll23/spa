<?php

declare(strict_types=1);

namespace VPA\Framework\Attributes;

#[\Attribute(\Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)] class Post implements HTTPTypeAttributeInterface
{
    public const NAME = 'POST';
    /**
     * @param string $path
     */
    public function __construct(string $path = '')
    {
    }
}
