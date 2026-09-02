<?php

class Database {
    private string $host    = 'localhost';
    private string $db      = 'hotel_cafe';
    private string $user    = 'root';
    private string $pass    = '';
    private string $charset = 'utf8mb4';
    private ?PDO $pdo       = null;

    public function connect(): PDO {
        if ($this->pdo === null) {
            $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            try {
                $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
            } catch (PDOException $e) {
                die("Database Connection Failed: " . $e->getMessage());
            }
        }

        return $this->pdo;
    }
}