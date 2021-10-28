<?php

namespace Bootstrap\Foundation;

use PDO;

class DB
{
    protected PDO $connection;

    public function __construct(string $host, string $port, string $dbName, string $userName, string $password)
    {
        try {
            $this->connection = new PDO(
                "mysql:host=$host;port=$port;charset=utf8mb4;dbname=$db",
                $userName,
                $password
            );
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}