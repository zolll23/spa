<?php

declare(strict_types=1);

namespace VPA\Framework;

class Collection implements \Iterator
{
    private int $position;

    /**
     * @param array $items
     */
    public function __construct(private array $items)
    {
        $this->position = 0;
    }

    /**
     * @return mixed
     */
    public function current(): mixed
    {
        return $this->items[$this->position];
    }

    /**
     * @return void
     */
    public function next(): void
    {
        ++$this->position;
    }

    /**
     * @return mixed
     */
    public function key(): mixed
    {
        return $this->position;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return isset($this->items[$this->position]);
    }

    /**
     * @return void
     */
    public function rewind(): void
    {
        $this->position = 0;
    }

    public function getAsArray(): array
    {
        return $this->items;
    }
}