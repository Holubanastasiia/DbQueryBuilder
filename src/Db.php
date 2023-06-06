<?php

namespace Anastasiia\DbQueryBuilder;

use PDO;
use PDOException;

class Db implements DbInterface
{
    private PDO $connection;
    public function __construct(
        protected string $host,
        protected string $dbname,
        protected string $user,
        protected string $password,
    )
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};";
            $this->connection = new PDO($dsn, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
        } catch (\Throwable $e) {
            echo $e;
        }
    }

    public function query(string $sql): array
    {
        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e;
        }
        return [];
    }
}