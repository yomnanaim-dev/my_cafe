<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class AuthController {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    // دالة التحقق من الكوكي أو الـ Session وتسجيل الدخول التلقائي
    public function checkRememberMe() {
        if (!isset($_SESSION["user_id"]) && isset($_COOKIE["remember_user"])) {
            $stmt = $this->db->query("SELECT * FROM users WHERE user_id = ?", [$_COOKIE["remember_user"]]);
           $cookieUser = $this->db->query("SELECT * FROM users WHERE user_id = ?", [$_COOKIE["remember_user"]])->find();
            
            if ($cookieUser) {
                $_SESSION["user_id"] = $cookieUser['user_id'];
                $_SESSION["user_name"] = $cookieUser['user_name'] ?? '';
                $_SESSION["user_role"] = $cookieUser['user_role'] ?? 'user';
                
                header("Location: /my_cafe/index.php");
                exit();
            }
        }
    }

    // دالة معالجة الـ Login عند الضغط على زر الدخول
    public function login() {
        $errorMessage = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = trim($_POST["email"] ?? '');
            $password = $_POST["password"] ?? '';

            if (!empty($email) && !empty($password)) {
                $statement = $this->db->query("SELECT * FROM users WHERE user_email = ?", [$email]);
             $user = $this->db->query("SELECT * FROM users WHERE user_email = ?", [$email])->find();

                if ($user && ($password === $user['user_password'] || password_verify($password, $user['user_password']))) {
                    $_SESSION["user_id"] = $user['user_id'];
                    $_SESSION["user_name"] = $user['user_name'] ?? '';
                    $_SESSION["user_role"] = $user['user_role'] ?? 'user';
                    
                    if (isset($_POST["remember"])) {
                        setcookie("remember_user", $user['user_id'], time() + (86400 * 30), "/");
                    }
                    
                    header("Location: /my_cafe/index.php");
                    exit();
                } else {
                    $errorMessage = "Invalid email or password.";
                }
            } else {
                $errorMessage = "Please fill in all fields.";
            }
        }
        return $errorMessage;
    }
}