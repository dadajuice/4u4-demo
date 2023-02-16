<?php

use PgSql\Connection;
use PgSql\Result;

class Database
{
    private Connection $connection;

    public function __construct()
    {
        $this->connection = pg_connect($this->buildConnectionString());
    }

    public function select(string $sql): array
    {
        $results = [];
        $result = $this->query($sql);
        while ($row = $this->parseResult($result)) {
            $results[] = $row;
        }
        return $results;
    }

    public function selectOne(string $sql): ?stdClass
    {
        $result = $this->query($sql);
        $row = $this->parseResult($result);
        if ($row === false) {
            return null;
        }
        return $row;
    }

    public function query(string $sql): Result
    {
        return pg_query($this->connection, $sql);
    }

    public function parseResult(Result $result): stdClass|bool
    {
        return pg_fetch_object($result);
    }

    private function buildConnectionString(): string
    {
        $host = getenv("DB_HOSTNAME");
        $user = getenv("DB_USERNAME");
        $password = getenv("DB_PASSWORD");
        $databaseName = getenv("DB_NAME");
        return "host=$host dbname=$databaseName user=$user password=$password";
    }
}
