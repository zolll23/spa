<?php

declare(strict_types=1);

namespace VPA\Framework\Attributes;

#[\Attribute(\Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)] class Delete implements HTTPTypeAttributeInterface
{
    public const NAME = 'DELETE';
    /**
     * @param string $path
     */
    public function __construct(string $path = '')
    {
    }
}
