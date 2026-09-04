<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../../config/Database.php'; // تأكد أن حرف D كبير مثل اسم الملف
require_once __DIR__ . '/../../controllers/AuthController.php';

// إنشاء اتصال باستخدام كلاس الليدر الجديد
$database = new Config\Database();
$db = $database->connect();

$auth = new AuthController($db);
$auth->checkRememberMe();
$errorMessage = $auth->login();
?>


<!DOCTYPE html>

<html>

<head>

    <title>Login</title>
   <link rel="stylesheet" href="../../public/css/login.css">


</head>

<body>

    <div class="login-container">

        <h1>Login</h1>
        <?php if (!empty($errorMessage)): ?>
    <div class="alert-error" style="color: red; margin-bottom: 15px;"><?php echo htmlspecialchars($errorMessage); ?></div>
     <?php endif; ?>

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
                submit
            </button>

        </form>

    </div>

</body>

</html>