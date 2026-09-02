<?php
// إيقاف إظهار التحذيرات أو المسارات على الشاشة لتنظيف الواجهة
error_reporting(0);
ini_set('display_errors', 0);

// التأكد من تشغيل الجلسة
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// التحقق من وجود Cookie سابقة لتسجيل الدخول التلقائي
if (!isset($_SESSION["user_id"]) && isset($_COOKIE["remember_user"])) {
    $_SESSION["user_id"] = $_COOKIE["remember_user"];
    $_SESSION["user_name"] = $_COOKIE["user_name"] ?? '';
    header("Location: /my_cafe/index.php");
    exit();
}

// استدعاء ملف الاتصال بقاعدة البيانات باستخدام المسار النسبي الصحيح
require_once __DIR__ . '/../../config/database.php';

$errorMessage = '';

// التحقق من أن طلب الصفحة تم إرساله عبر طريقة POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"] ?? '');
    $password = $_POST["password"] ?? '';

    // التحقق من أن الحقول غير فارغة
    if (!empty($email) && !empty($password)) {
        
        // جلب المستخدم من قاعدة البيانات بأمان باستخدام Prepared Statements لمنع الـ SQL Injection
        $statement = $db->query("SELECT * FROM users WHERE email = ?", [$email]);
        $user = $statement->fetch();

        // التحقق من وجود المستخدم ومطابقة كلمة المرور المشفرة
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION["user_id"] = $user['id'];
            $_SESSION["user_name"] = $user['name'] ?? '';
            
            // تفعيل Remember Me وتخزين الكوكيز لمدة 30 يوماً عند تحديد الخيار
            if (isset($_POST["remember"])) {
                setcookie("remember_user", $user['id'], time() + (86400 * 30), "/");
                setcookie("user_name", $user['name'] ?? '', time() + (86400 * 30), "/");
            }
            
            // إعادة التوجيه إلى الصفحة الرئيسية للموقع عند نجاح تسجيل الدخول
            header("Location: /my_cafe/index.php");
            exit();
        } else {
            $errorMessage = "Invalid email or password.";
        }
    } else {
        $errorMessage = "Please fill in all fields.";
    }
}
?>


<!DOCTYPE html>

<html>

<head>

    <title>Login</title>
<style>
* {
    margin: 0;
    padding: 0;
   
}

body {
    font-family: Arial, sans-serif;

    background-color: #FFF8EC;
    background-image: url("WhatsApp Image 2026-08-31 at 1.18.55 AM.jpeg");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;

    display: flex;
    justify-content: center;
    align-items: center;

    min-height: 100vh;
}


/* Login Container */
.login-container {
    width: 450px;
    padding: 40px;

    background: rgba(255, 248, 236, 0.55);

    border: 1px solid rgba(255, 255, 255, 0.8);
    border-radius: 20px;

   
}


/* Title */
h1 {
    text-align: center;

    color: #3F5632;

    font-size: 42px;

    margin-bottom: 35px;
}


/* Input Group */
.input-group {
    display: flex;
    flex-direction: column;

    margin-bottom: 20px;
}


/* Labels */
.input-group label {
    margin-bottom: 8px;

    color: #3F5632;

    font-weight: bold;
}


/* Inputs */
.input-group input {
    height: 45px;

    padding: 0 12px;

    border: 1.5px solid #B8C3A5;
    border-radius: 10px;

    background-color: rgba(255, 255, 255, 0.75);

    color: #3F5632;

    font-size: 16px;

    transition: 0.3s;
}


/* Placeholder */
.input-group input::placeholder {
    color: #8A967D;
}


/* Input Focus */
.input-group input:focus {
    outline: none;

    border-color: #546B41;

    background-color: rgba(255, 255, 255, 0.9);

    
}


/* Remember Me */
.remember-me {
    display: flex;
    align-items: center;

    gap: 8px;

    margin-bottom: 20px;

    color: #3F5632;

    font-weight: bold;
}


/* Checkbox */
.remember-me input {
    width: 16px;
    height: 16px;

    cursor: pointer;

   
}


/* Button */
button {
    width: 100%;
    height: 45px;

    border: none;
    border-radius: 10px;

    background-color: #546B41;

    color: #FFF8EC;

    font-size: 17px;

    font-weight: bold;

    cursor: pointer;

    transition: 0.3s;
}


/* Button Hover */
button:hover {
    background-color: #3F5632;

}
</style>

</head>

<body>

    <div class="login-container">

        <h1>Login</h1>

        <form method="POST">

            <div class="input-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email"
                    required
                >

            </div>


            <div class="input-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >

            </div>


            <div class="remember-me">

                <input
                    type="checkbox"
                    name="remember"
                >

                <label>Remember Me</label>

            </div>


            <button type="submit">
                Login
            </button>

        </form>

    </div>

</body>

</html>