<?php

namespace SploderRevival\database;

class ConnectionManager implements IConnectionManager
{
    private readonly string $connection_string;
    private \PDO|null $connection;

    public function __construct(string $connection_string)
    {
        $this->connection_string = $connection_string;
        $this->connection = null;
    }

    public function getConnection(): \PDO
    {
        if ($this->connection == null) {
            $this->connection = new \PDO($this->connection_string);
        }

        return $this->connection;
    }
}
