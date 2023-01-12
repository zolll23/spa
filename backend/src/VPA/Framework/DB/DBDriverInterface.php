<?php

declare(strict_types=1);

namespace VPA\Framework\DB;

use VPA\DI\Injectable;
use VPA\Framework\Collection;

#[Injectable]
interface DBDriverInterface
{
    /**
     * @return void
     */
    public function connect(): void;

    /**
     * @param string $tableName
     * @return Collection
     */
    public function buildAndExecQuery(string $tableName, ConditionsDto $conditions, array $orders): Collection;

    /**
     * @param string $tableName
     * @param array $data
     * @return int
     */
    public function insert(string $tableName, array $data): int;
}