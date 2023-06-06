<?php

namespace Anastasiia\DbQueryBuilder;

interface DbInterface
{
    public function query(string $sql): array;
}