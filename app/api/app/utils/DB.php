<?php

class DB
{
    private ?mysqli $conn;

    public function __construct(
        string $dbHost = DB_HOST,
        string $dbUser = DB_USER,
        string $dbPassword = DB_PASS,
        string $dbDatabase = DB_NAME,
        string $dbPort = "3306"
    ) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbDatabase, $dbPort);
        $this->query("SET NAMES utf8mb4");
    }

    public function close(): bool
    {
        return (bool) mysqli_close($this->conn);
    }

    public function query(string $query): DbResult|bool
    {
        $result = $this->conn->query($query);
        if (!$result) {
            throw new Exception($this->conn->error);
        }
        return $result instanceof mysqli_result
            ? new DbResult($result)
            : (bool) $result;
    }
}
