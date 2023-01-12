<?php

declare(strict_types=1);

namespace VPA\Framework;

interface RouterInterface
{
    /**
     * Добавляет маршрут в список
     *
     * @param string $type
     * @param string $path
     * @param array $middleware
     * @param array $method
     *
     * @return void
     */
    public function addRoute(string $type, string $path, array $middleware, array $method): void;

    /**
     * Анализирует текущий HTTP запрос и ищет маршрут, который ему соответствует и вызывает нужный контроллер
     *
     * @return void
     */
    public function apply(): void;
}
