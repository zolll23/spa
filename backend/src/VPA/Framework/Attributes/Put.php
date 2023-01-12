<?php

declare(strict_types=1);

namespace VPA\Framework\Attributes;

#[\Attribute(\Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)] class Put implements HTTPTypeAttributeInterface
{
    public const NAME = 'PUT';
    /**
     * @param string $path
     */
    public function __construct(string $path = '')
    {
    }
}
