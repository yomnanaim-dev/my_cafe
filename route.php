<?php
// route.php

require_once 'config/database.php';
require_once 'controllers/OrderController.php';

// اتصال قاعدة البيانات
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// إنشاء Object من الـ Controller
$orderController = new OrderController($db);

// =============================================
// طريقة مبسطة لتحديد الـ URL
// =============================================

// نجيب الرابط من $_SERVER
$url = $_SERVER['REQUEST_URI'];

// نشيل الجزء الخاص بالمشروع
$basePath = '/my_cafe';
if (strpos($url, $basePath) === 0) {
    $url = substr($url, strlen($basePath));
}

// نشيل أي علامات استفهام (parameters)
if (strpos($url, '?') !== false) {
    $url = substr($url, 0, strpos($url, '?'));
}

// نتأكد إن الرابط يبدأ بـ /
if ($url != '' && $url[0] != '/') {
    $url = '/' . $url;
}

// لو الرابط فاضي، نخليه /
if (empty($url) || $url == '') {
    $url = '/';
}

// =============================================
// التوجيه
// =============================================

// لو الرابط هو الصفحة الرئيسية
if ($url == '/' || $url == '/index.php') {
    require 'views/home/index.php';
    exit;
}

// Routes الخاصة بـ Admin Orders
switch ($url) {
    case '/admin/current-orders':
        $orderController->currentOrders();
        break;
        
    case '/admin/checks':
        $orderController->checks();
        break;
        
    case '/admin/update-status':
        $orderController->updateStatus();
        break;
        
    default:
        // لو الرابط يبدأ بـ /admin/order-details/
        if (strpos($url, '/admin/order-details/') === 0) {
            $parts = explode('/', $url);
            $orderId = end($parts);
            if (is_numeric($orderId)) {
                $orderController->orderDetails($orderId);
            } else {
                echo "Invalid order ID";
            }
        }
        // لو الرابط يبدأ بـ /admin/order-details/user/
        elseif (strpos($url, '/admin/order-details/user/') === 0) {
            $parts = explode('/', $url);
            $userId = end($parts);
            if (is_numeric($userId)) {
                $fromDate = $_GET['from'] ?? date('Y-m-d', strtotime('-7 days'));
                $toDate = $_GET['to'] ?? date('Y-m-d');
                $orderController->userOrders($userId, $fromDate, $toDate);
            } else {
                echo "Invalid user ID";
            }
        }
        else {
            // لو مش لاقي الرابط
            http_response_code(404);
            echo "<h1>404 - Page Not Found</h1>";
            echo "<p>The URL <strong>$url</strong> does not exist.</p>";
            echo "<p><a href='/my_cafe/'>Go Home</a></p>";
        }
        break;
}
?>