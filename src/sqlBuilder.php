<?php

namespace Anastasiia\DbQueryBuilder;

class sqlBuilder
{
    private string $table;
    private array $select;
    private array $where;
    private array $order;
    private int $limit;
    private int $offset;

    public function table( string $table): self
    {
        $this->table = $table;
        return $this;
    }

    public function select(array $select): self
    {
        $this->select = $select;
        return $this;
    }

    public function where(array $where): self
    {
        $this->where = $where;
        return $this;
    }
    public function order(array $order): self
    {
        $this->order = $order;
        return $this;
    }

    public function limit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset(int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    public function getSql() {
        $sql = "SELECT ";

        if (!empty($this->select)) {
            $sql .= implode(", ", $this->select);
        } else {
            $sql .= "*";
        }

        $sql .= " FROM " . $this->table;

        if (!empty($this->where)) {
            $sql .= " WHERE " . $this->buildConditions($this->where);
        }

        if (!empty($this->order)) {
            $sql .= " ORDER BY " . $this->buildOrderBy($this->order);
        }
        if (!empty($this->limit)) {
            $sql .= " LIMIT " . $this->limit;
        }

        if (!empty($this->offset)) {
            $sql .= " OFFSET " . $this->offset;
        }

        return $sql;
    }

    private function buildConditions($conditions) {
        $conditionsSql = [];
        foreach ($conditions as $column => $value) {
            $conditionsSql[] = $column . " = " . $this->quoteValue($value);
        }
        return implode(" AND ", $conditionsSql);
    }

    private function buildOrderBy($orderBy) {
        $orderBySql = [];
        foreach ($orderBy as $column => $direction) {
            $orderBySql[] = $column . " " . $direction;
        }
        return implode(", ", $orderBySql);
    }

    private function quoteValue($value) {
        return "'" . $value . "'";
    }
}