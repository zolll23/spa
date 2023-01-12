<?php

declare(strict_types=1);

namespace VPA\Framework\Controllers;

use ReflectionClass;
use ReflectionMethod;
use VPA\DI\Injectable;
use VPA\Framework\Attributes\Delete;
use VPA\Framework\Attributes\Get;
use VPA\Framework\Attributes\Post;
use VPA\Framework\Attributes\Put;
use VPA\Framework\Exceptions\ControllerException;
use VPA\Framework\Exceptions\RouteAlreadyExistsException;
use VPA\Framework\Exceptions\RouteNotFoundException;
use VPA\Framework\Router;

#[Injectable]
class Controller
{
    /**
     * Инициализирует маршруты методами текущего контроллера
     *
     * @throws ControllerException
     */
    public function __construct(private Router $router)
    {
        try {
            $this->parseAttributes();
        } catch (RouteAlreadyExistsException $e) {
        } catch (RouteNotFoundException $e) {
            throw new ControllerException("Controller " . static::class . " have routing error", 500, $e);
        }
    }

    /**
     * @return void
     * @throws RouteNotFoundException
     * @throws RouteAlreadyExistsException
     */
    private function parseAttributes(): void
    {
        $types = [Get::class, Post::class, Put::class, Delete::class];
        $reflectionClass = new ReflectionClass(static::class);
        $methods = $reflectionClass->getMethods(ReflectionMethod::IS_PUBLIC);
        foreach ($methods as $method) {
            foreach ($types as $type) {
                $getAttributes = $method->getAttributes($type);
                foreach ($getAttributes as $getAttribute) {
                    $name = $type::NAME;
                    $arguments = $getAttribute->getArguments();
                    if (!array_key_exists('path', $arguments)) {
                        throw new RouteNotFoundException("Undefined path in route");
                    }
                    $methodSignature = ['class' => static::class, 'name' => $method->getName()];
                    $this->router->addRoute($name, $arguments['path'], [], $methodSignature);
                }
            }
        }
    }
}
