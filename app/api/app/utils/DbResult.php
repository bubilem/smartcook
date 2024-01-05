<?php

class DBResult
{

    private PDOStatement $statement;

    public function __construct(PDOStatement $statement)
    {
        $this->statement = $statement;
    }

    public function affectedRowsCount(): int
    {
        return $this->statement->rowCount();
    }

    public function fetchAll(): array
    {
        return $this->statement->fetchAll();
    }

}