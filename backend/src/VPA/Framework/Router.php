<?php

declare(strict_types=1);

namespace VPA\Framework;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use VPA\DI\Container;
use VPA\DI\Injectable;
use VPA\Framework\Exceptions\PageNotFoundException;
use VPA\Framework\Exceptions\RouteAlreadyExistsException;

#[Injectable]
class Router implements RouterInterface
{
    private static array $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => [],
    ];

    /**
     * @param RequestInterface $request
     */
    public function __construct(private RequestInterface $request)
    {
    }

    /**
     * @inheritDoc
     *
     * @param string $type
     * @param string $path
     * @param array  $middleware
     * @param array  $method
     * @return void
     *
     * @throws RouteAlreadyExistsException
     */
    public function addRoute(string $type, string $path, array $middleware, array $method): void
    {
        if ($this->has($type, $path)) {
            throw new RouteAlreadyExistsException(
                sprintf("%s %s already exists (%s)", $type, $path, implode("::", $method))
            );
        }
        self::$routes[$type][$path] = [
            'middleware' => $middleware,
            'method' => $method
        ];
    }

    /**
     * @param string $type
     * @param string $path
     *
     * @return bool
     */
    private function has(string $type, string $path): bool
    {
        if (isset(self::$routes[$type][$path])) {
            return true;
        }
        return false;
    }

    /**
     * @inheritDoc
     * @throws PageNotFoundException
     */
    public function apply(): void
    {
        $method = $this->request->getMethod();
        $path = $this->request->getUri()->getPath();
        $info = $this->findCurrentPath($method, $path);
        try {
            $controller = (new Container())->get($info->getMethodClass());
            $method = $info->getMethodName();
            $response = $controller->$method($this->request);
            $this->output($response);
        } catch (\Throwable $e) {
            throw new PageNotFoundException("Page not found", 404, $e);
        }
    }

    /**
     * @param ResponseInterface $response
     * @return void
     */
    private function output(ResponseInterface $response): void
    {
        http_response_code($response->getStatusCode());
        foreach ($response->getHeaders() as $headerName => $headerValues) {
            foreach ($headerValues as $headerValue) {
                header("{$headerName}: {$headerValue}");
            }
        }
        echo $response->getBody()->getContents();
    }

    /**
     * @param string $method
     * @param string $uriPath
     * @return Route
     * @throws PageNotFoundException
     */
    private function findCurrentPath(string $method, string $uriPath): Route
    {
        $info = self::$routes[$method][$uriPath] ?? false;
        if (!$info) {
            throw new PageNotFoundException("Page not found");
        }
        return new Route($info['method']['class'], $info['method']['name']);
    }
}
