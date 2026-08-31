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
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }

    public function query($query)
    {
        $statement = $this->connection->prepare($query);
        $statement->execute();

        return $statement;
    }
}

$db = new DataBase();

$result = $db->query("SELECT * FROM users")->fetchAll();

var_dump($result);