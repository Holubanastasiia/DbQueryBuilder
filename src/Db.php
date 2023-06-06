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
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function query(string $sql): array
    {
        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo $e;
        }
        return $result;
    }
}