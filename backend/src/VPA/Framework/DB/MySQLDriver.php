<?php

declare(strict_types=1);

namespace VPA\Framework\DB;

use PDO;
use Spa\Config;
use VPA\Framework\Collection;
use VPA\Framework\Exceptions\DBException;

class MySQLDriver implements DBDriverInterface
{
    private static PDO|null $connection = null;
    private array $connectInfo;

    /**
     * @throws DBException
     */
    public function __construct(private Config $config)
    {
        if (!array_key_exists("mysql", $this->config->connections) || empty($this->config->connections['mysql'])) {
            throw new DBException("Incorrect connection config for MySQL");
        }
        $this->connectInfo = $this->config->connections['mysql'] ?? false;
        if (is_null(self::$connection)) {
            $this->connect();
        }
    }

    /**
     * @return void
     */
    public function connect(): void
    {
        $host = $this->connectInfo['host'];
        $db = $this->connectInfo['database'];
        $user = $this->connectInfo['user'];
        $password = $this->connectInfo['password'];
        self::$connection = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    }

    /**
     * @param string $tableName
     * @param ConditionsDto $conditions
     * @param array $orders
     *
     * @return Collection
     */
    public function buildAndExecQuery(string $tableName, ConditionsDto $conditions, array $orders): Collection
    {
        $where = $orderby = '';
        if ($conditions->id) {
            $where = sprintf("WHERE id=%d", $conditions->id);
        }
        if (!empty($orders)) {
            $orderby = sprintf(" ORDER BY %s", implode(",", $orders));
        }
        $query = trim("SELECT * FROM {$tableName} {$where} {$orderby}");
        $sth = self::$connection->query($query);
        $rows = $sth->fetchAll();
        return new Collection($rows);
    }

    /**
     * @param string $tableName
     * @param array $data
     *
     * @return int
     * @throws DBException
     */
    public function insert(string $tableName, array $data): int
    {
        $fields = array_keys($data);
        $query = sprintf(
            "INSERT INTO {$tableName} (%s) VALUES(%s)",
            implode(",", $fields),
            implode(",", array_fill(0, count($fields), '?')),
        );
        $stmt = self::$connection->prepare($query);
        try {
            $stmt->execute(array_values($data));
            return intval(self::$connection->lastInsertId());
        } catch (\Throwable $e) {
            throw new DBException("MySql error", 500, $e);
        }
    }
}
