<?php

class DataBase
{
    public $connection;

    public function __construct()
    {
        $dsn = "mysql:host=localhost;port=3306;dbname=hotel_cafe;charset=utf8mb4";

        $this->connection = new PDO(
            $dsn,
            'root',
            'root',
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }

    public function query($query, $params = [])
    {
        $statement = $this->connection->prepare($query);
        $statement->execute($params);

        return $statement;
    }
}

$db = new DataBase();