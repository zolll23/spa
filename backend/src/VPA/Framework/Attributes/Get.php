<?php

declare(strict_types=1);

namespace VPA\Framework\Attributes;

#[\Attribute(\Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)] class Get implements HTTPTypeAttributeInterface
{
    public const NAME = 'GET';
    /**
     * @param string $path
     */
    public function __construct(public string $path = '')
    {
    }
}

