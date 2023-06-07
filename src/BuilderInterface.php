<?php

namespace Anastasiia\DbQueryBuilder;

interface BuilderInterface
{
    /**
     * @param array|string $columns
     * @return $this
     */
    public function select(string| array $columns): BuilderInterface;

    /**
     * @param array|string $conditions
     * @return $this
     */
    public function where(array|string $conditions): BuilderInterface;

    /**
     * @param string $table
     * @return $this
     */
    public function table(string $table): BuilderInterface;

    /**
     * @param int $limit
     * @return $this
     */
    public function limit(int $limit): BuilderInterface;

    /**
     * @param int $offset
     * @return $this
     */
    public function offset( int $offset): BuilderInterface;

    /**
     * @param array|string $order
     * @return $this
     */
    public function order(array|string $order): BuilderInterface;
}