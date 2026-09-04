<?php
// index.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// =============================================
// اتصال قاعدة البيانات
// =============================================
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'hotel_cafe';

$db = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// =============================================
// استدعاء الـ Controller
// =============================================
require_once 'controllers/OrderController.php';

// إنشاء Object من الـ Controller
$orderController = new OrderController($db);

// =============================================
// تحديد الـ URL من $_GET
// =============================================
$action = $_GET['action'] ?? 'home';

// =============================================
// التوجيه
// =============================================
switch ($action) {
    case 'current-orders':
        $orderController->currentOrders();
        break;
        
    case 'checks':
        $orderController->checks();
        break;
        
    case 'update-status':
        $orderController->updateStatus();
        break;
        
    case 'order-details':
        $orderId = $_GET['id'] ?? null;
        if ($orderId) {
            $orderController->orderDetails($orderId);
        } else {
            echo "Missing order ID";
        }
        break;
        
    case 'user-orders':
        $userId = $_GET['user_id'] ?? null;
        $fromDate = $_GET['from'] ?? date('Y-m-d', strtotime('-7 days'));
        $toDate = $_GET['to'] ?? date('Y-m-d');
        if ($userId) {
            $orderController->userOrders($userId, $fromDate, $toDate);
        } else {
            echo "Missing user ID";
        }
        break;
        
    default:
        // الصفحة الرئيسية
        require 'views/home/index.php';
        break;
}
?>