<?php

namespace App\Helpers;

class QueryBuilder
{
    private string $query = '';
    private \PDO $pdo;
    private array $params = [];

    public function __construct(\PDO $pdo)
    {
        $this->reset();
        $this->pdo = $pdo;
    }

    public function addSelect(string $table, ...$fields): self
    {
        $this->query .= 'SELECT ' . implode(',', $fields) . " FROM $table";

        return $this;
    }

    public function addWhere(
        string $firstField,
        string $operator,
        string $secondField
    ): self
    {
        $this->query .= " WHERE $firstField $operator $secondField";

        return $this;
    }

    public function addOrderBy(string $field, string $order)
    {
        $this->query .= " ORDER BY $field $order";

        return $this;
    }

    public function addInsert(
        string $table,
        array $columnsAndValues
    ): self
    {
        $columns = array_keys($columnsAndValues);
        $values = array_values($columnsAndValues);

        $this->query .= sprintf(
            'INSERT INTO %s (%s) VALUES (%s);',
            $table,
            implode(',', $columns),
            implode(',', $values)
        );


        return $this;
    }

    public function addSQL(string $sql): self
    {
        $this->query .= $sql;

        return $this;
    }

    public function setParameter(string $param, string $value): self
    {
        $this->params[$param] = $value;

        return $this;
    }

    public function setParameters(array $params): self
    {
        foreach ($params as $param => $value) {
            $this->params[$param] = $value;
        }

        return $this;
    }

    public function getQuery(): array|false
    {
        $stmt = $this->pdo->prepare($this->query);
        try {
            $stmt->execute($this->params);
        } catch (\Exception $e) {
            throw new \LogicException('QueryBuilder Error: ' . $e->getMessage());
        }

        $this->reset();

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    private function reset(): void
    {
        $this->query = '';
        $this->params = [];
    }
}