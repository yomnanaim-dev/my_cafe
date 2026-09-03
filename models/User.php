
<?php

require_once BASE_PATH . '/config/Database.php';

class User {
    private PDO $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function getAll(): array {
        return $this->db->query("SELECT users.*, room.room_number FROM users LEFT JOIN room ON users.room_id = room.room_id ORDER BY user_id DESC")->fetchAll();
    }

    public function find(int $id): array|false {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create(array $data): bool {
        $sql = "INSERT INTO users (user_name, user_email, user_password, room_id, ext, user_image) 
                VALUES (:user_name, :user_email, :user_password, :room_id, :ext, :user_image)";
        return $this->db->prepare($sql)->execute($data);
    }

    public function update(int $id, array $data): bool {
        $fields = "user_name = :user_name, user_email = :user_email, room_id = :room_id, ext = :ext";
        if (isset($data['user_image'])) {
            $fields .= ", user_image = :user_image";
        }
        
        $data['id'] = $id;
        return $this->db->prepare("UPDATE users SET {$fields} WHERE user_id = :id")->execute($data);
    }

    public function delete(int $id): bool {
       
        $user = $this->find($id);
        if ($user && !empty($user['user_image']) && file_exists(BASE_PATH . '/' . $user['user_image'])) {
            unlink(BASE_PATH . '/' . $user['user_image']);
        }

        
        $this->db->prepare("DELETE FROM order_item WHERE order_id IN (SELECT order_id FROM orders WHERE user_id = :id)")->execute(['id' => $id]);
        $this->db->prepare("DELETE FROM orders WHERE user_id = :id")->execute(['id' => $id]);
        
        return $this->db->prepare("DELETE FROM users WHERE user_id = :id")->execute(['id' => $id]);
    }
}