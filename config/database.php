<?php

<<<<<<< HEAD
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
=======
namespace Core;

use PDO;

class Database
{
    public $connection;
    public $statement;

    public function __construct($config)
    {
        $dsn = "mysql:" . http_build_query($config, '', ';');
        $this->connection = new PDO(dsn: $dsn, options: [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = []) // to avoid sql injection
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);
        // return $statement;
        return $this;
    }

    public function get()
    {
        // $results = $this->statement->fetchAll();
        // if (empty($results)) {
        //     abort();
        // }else {
        //     return $results;
        // }
        return $this->statement->fetchAll();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();
        if (!$result) {
            abort();
        } else {
            return $result;
        }
    }
}
>>>>>>> be44a5a1d630a79fee5595318208f9da8445b0c1
