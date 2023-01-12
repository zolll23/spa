<?php

declare(strict_types=1);

namespace Spa;

use HttpSoft\ServerRequest\ServerRequestCreator;
use HttpSoft\Response\JsonResponse;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Spa\Domains\Comments\CommentRepositoryInterface;
use Spa\Repositories\CommentRepository;
use VPA\DI\Injectable;
use VPA\Framework\DB\DBDriverInterface;
use VPA\Framework\DB\MySQLDriver;

#[Injectable]
class Config
{
    public array $containers = [];
    public array $connections = [];

    /**
     * @return void
     */
    public function __construct()
    {
        $this->containers = [
            RequestInterface::class => ServerRequestCreator::create(),
            ResponseInterface::class => JsonResponse::class,
            CommentRepositoryInterface::class => CommentRepository::class,
            DBDriverInterface::class => MySQLDriver::class,
        ];
        $this->connections = [
            'mysql' => [
                'host' => 'mysql',
                'port' => 3306,
                'user' => 'root',
                'password' => 'iniT1',
                'database' => 'spa',
            ],
        ];
    }
}
