<?php

declare(strict_types=1);

namespace VPA\Framework;

class Route
{
    /**
     * @param string $methodClass
     * @param string $methodName
     */
    public function __construct(private string $methodClass, private string $methodName)
    {
    }

    /**
     * @return string
     */
    public function getMethodClass(): string
    {
        return $this->methodClass;
    }

    /**
     * @return string
     */
    public function getMethodName(): string
    {
        return $this->methodName;
    }
}
