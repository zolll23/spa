<?php

declare(strict_types=1);

namespace VPA\Framework;

use ReflectionClass;
use ReflectionProperty;
use VPA\DI\Container;
use VPA\DI\Injectable;
use VPA\Framework\DB\ConditionsDto;
use VPA\Framework\DB\DBDriverInterface;
use VPA\Framework\Exceptions\DBException;

#[Injectable]
class Model
{
    protected string $tableName = '';
    protected int $id;
    protected array $orders = [];
    private ?ConditionsDto $conditions = null;

    /**
     * @param DBDriverInterface $db
     */
    public function __construct(private DBDriverInterface $db)
    {
    }

    /**
     * Осуществляет подготовку условий для поиска
     *
     * @return $this
     */
    public function find(?ConditionsDto $conditions = null): static
    {
        if ($conditions) {
            $this->conditions = $conditions;
        } else {
            $this->conditions = new ConditionsDto();
        }
        return $this;
    }

    /**
     * @param array $orders
     *
     * @return $this
     */
    public function orderBy(array $orders): static
    {
        $this->orders = $orders;
        return $this;
    }


    /**
     * Возвращает результаты поиска
     *
     * @return Collection
     */
    public function get(): Collection
    {
        return $this->db->buildAndExecQuery($this->tableName, $this->conditions, $this->orders);
    }

    /**
     * Возвращает первую запись из результатов
     *
     * @return array
     */
    public function getFirst(): array
    {
        $rows = $this->db->buildAndExecQuery($this->tableName, $this->conditions, $this->orders);
        return current($rows->getAsArray());
    }

    /**
     * @return array
     */
    public function insert(): array
    {
        $reflectionClass = new ReflectionClass(static::class);
        $properties = $reflectionClass->getProperties(ReflectionProperty::IS_PUBLIC);
        $data = [];
        foreach ($properties as $property) {
            $name = $property->getName();
            $data[$name] = $this->{$name};
        }
        $id = $this->db->insert($this->tableName, $data);
        $this->id = $id;
        $conditions = new ConditionsDto();
        $conditions->id = $id;
        $newRecord = $this->find($conditions)->getFirst();
        return $newRecord;
    }

    /**
     * @return Model
     * @throws DBException
     */
    public function new(): Model
    {
        try {
            $model = (new Container())->get(static::class);
            assert($model instanceof Model);
            return $model;
        } catch (\Throwable $e) {
            throw new DBException("Can`t create new " . static::class . " record", 500, $e);
        }
    }
}
