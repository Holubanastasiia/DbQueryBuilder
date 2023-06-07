<?php

namespace Anastasiia\DbQueryBuilder;

//class sqlBuilder implements BuilderInterface
//{
//    private string $table;
//    private array $columns;
//    private array $where;
//    private array $order;
//    private int $limit;
//    private int $offset;
//
//    public function table( string $table): self
//    {
//        $this->table = $table;
//        return $this;
//    }
//
//    public function select(array|string $columns): self
//    {
//        $this->select = $columns;
//        return $this;
//    }
//
//    public function where(array $where): self
//    {
//        $this->where = $where;
//        return $this;
//    }
//    public function order(array $order): self
//    {
//        $this->order = $order;
//        return $this;
//    }
//
//    public function limit(int $limit): self
//    {
//        $this->limit = $limit;
//        return $this;
//    }
//
//    public function offset(int $offset): self
//    {
//        $this->offset = $offset;
//        return $this;
//    }
//
//    public function getSql() {
//        $sql = "SELECT ";
//
//        if (!empty($this->select)) {
//            $sql .= implode(", ", $this->select);
//        } else {
//            $sql .= "*";
//        }
//
//        $sql .= " FROM " . $this->table;
//
//        if (!empty($this->where)) {
//            $sql .= " WHERE " . $this->buildConditions($this->where);
//        }
//
//        if (!empty($this->order)) {
//            $sql .= " ORDER BY " . $this->buildOrderBy($this->order);
//        }
//        if (!empty($this->limit)) {
//            $sql .= " LIMIT " . $this->limit;
//        }
//
//        if (!empty($this->offset)) {
//            $sql .= " OFFSET " . $this->offset;
//        }
//
//        return $sql;
//    }
//
//    private function buildConditions($conditions) {
//        $conditionsSql = [];
//        foreach ($conditions as $column => $value) {
//            $conditionsSql[] = $column . " = " . $this->quoteValue($value);
//        }
//        return implode(" AND ", $conditionsSql);
//    }
//
//    private function buildOrderBy($orderBy) {
//        $orderBySql = [];
//        foreach ($orderBy as $column => $direction) {
//            $orderBySql[] = $column . " " . $direction;
//        }
//        return implode(", ", $orderBySql);
//    }
//
//    private function quoteValue($value) {
//        return "'" . $value . "'";
//    }
//}

class sqlBuilder implements BuilderInterface
{
    private array|string $columns;
    private array|string $conditions;
    private string $table;
    private int $limit;
    private int $offset;
    private array|string $order;

    public function select(array|string $columns): BuilderInterface
    {
        $this->columns = $columns;
        return $this;
    }

    public function where(array|string $conditions): BuilderInterface
    {
        $this->conditions = $conditions;
        return $this;
    }

    public function table(string $table): BuilderInterface
    {
        $this->table = $table;
        return $this;
    }

    public function limit(int $limit): BuilderInterface
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset(int $offset): BuilderInterface
    {
        $this->offset = $offset;
        return $this;

    }

    public function order(array|string $order): BuilderInterface
    {
        $this->order = $order;
        return $this;
    }

    public function getSql() {
        $sql = "SELECT ";

        if (!empty($this->columns)) {
            $sql .= implode(", ", $this->columns);
        } else {
            $sql .= "*";
        }

        $sql .= " FROM " . $this->table;

        if (!empty($this->conditions)) {
            $sql .= " WHERE " . $this->buildConditions($this->conditions);
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