<?php

namespace Config;

use PDO;
use PDOException;

class Database {
    private string $host = 'localhost';
    private string $dbname = 'hotel_cafe'; // حط هنا اسم الداتا بيز بتاعتك بالضبط
    private string $user = 'root';
    private string $pass = 'root'; // لو مفيش باسوورد سيبها فاضية زي ما هي
    private string $charset = 'utf8mb4';
    private ?PDO $pdo = null;
    
    public function connect(): PDO {
        if ($this->pdo === null) {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
                $this->pdo = new PDO($dsn, $this->user, $this->pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (PDOException $e) {
                die("Database Error: " . $e->getMessage());
            }
        }
        return $this->pdo;
    }
    
    public function fetchAll(string $query, array $params = []): array {
        $stmt = $this->connect()->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    
    public function fetch(string $query, array $params = []): ?array {
        $stmt = $this->connect()->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetch();
        return $result ?: null;
    }
    
    public function execute(string $query, array $params = []): bool {
        $stmt = $this->connect()->prepare($query);
        return $stmt->execute($params);
    }
    
    public function lastInsertId(): string {
        return $this->connect()->lastInsertId();
    }
}