<?php

declare(strict_types=1);

namespace VPA\Framework;

use Spa\Config;
use VPA\DI\Container;
use VPA\DI\Injectable;
use VPA\DI\NotFoundException;
use VPA\Framework\Exceptions\InternalErrorException;

#[Injectable]
class App
{
    protected Container $di;
    protected array $controllers = [];
    protected array $repositories = [];
    protected array $providers = [];

    /**
     * @param Config $config
     * @param Router $router
     * @throws InternalErrorException
     */
    public function __construct(
        protected readonly Config $config,
        protected readonly Router $router,
    ) {
        $this->di = new Container();
        try {
            $this->di->registerContainers($config->containers);
        } catch (NotFoundException $e) {
            throw new InternalErrorException("Internal error", 500, $e);
        }
    }

    /**
     * Инициализирует приложение
     *
     * @return void
     */
    public function init()
    {
    }

    /**
     * @return void
     * @throws InternalErrorException
     */
    public function bootstrap()
    {
        try {
            foreach ($this->controllers as $controller) {
                $this->di->get($controller);
            }
            $this->router->apply();
        } catch (\Throwable $e) {
            throw new InternalErrorException("Internal error", 500, $e);
        }
    }
}
