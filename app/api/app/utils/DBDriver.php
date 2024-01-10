<?php

class DBDriver
{
    private ?PDO $conn;

    public function __construct(
        string $host = DB_HOST,
        string $user = DB_USER,
        string $pass = DB_PASS,
        string $dbnm = DB_NAME
    ) {
        $this->conn = new PDO(
            "mysql:host=$host;dbname=$dbnm;port=3306",
            $user,
            $pass,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'"
            ]
        );
    }

    public function query(string $query, ?array $params = null): DBResult
    {
        if ($params === null) {
            $statement = $this->conn->query($query);
        } else {
            $statement = $this->conn->prepare($query);
            $statement->execute($params);
        }
        return new DBResult($statement);
    }

    public function lastInsertId(): string
    {
        return (string) $this->conn->lastInsertId();
    }
}
