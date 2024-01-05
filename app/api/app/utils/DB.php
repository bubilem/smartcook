<?php

class DB
{
    private static ?DBDriver $dbDriver = null;

    public static function query(string $query, ?array $params = null): DBResult
    {
        if (self::$dbDriver === null) {
            self::$dbDriver = new DBDriver;
        }
        return self::$dbDriver->query($query, $params);
    }

}