<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class AdminController {
    private $db;

    public function __construct($database) {
        $this->db = $database;
        
        // حماية أمان صارمة: التأكد إن اللي دخل الصفحة دي هو أدمن فقط
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            header("Location: /my_cafe/index.php");
            exit();
        }
    }

    // دالة لجلب كل المستخدمين باستخدام دالة get() المتوافقة مع كلاس الـ Database
    public function getAllUsers() {
        return $this->db->query("SELECT user_id, user_name, user_email, user_role FROM users")->get();
    }
}