<?php
// controllers/OrderController.php

require_once 'models/Order.php';

// إنشاء اتصال بقاعدة البيانات (افترض إنه موجود في config/database.php)
// لو مش موجود، هتحتاج تضبطه حسب نظامكم
require_once 'config/database.php';
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// التحقق من الاتصال
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$orderController = new OrderController($db);

// تحديد الـ Action بناءً على الـ URL
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($path) {
    case '/admin/checks':
        $orderController->checks();
        break;
        
    case '/admin/current-orders':
        $orderController->currentOrders();
        break;
        
    case '/admin/update-status':
        $orderController->updateStatus();
        break;
        
    default:
        // لو فيه Route dynamic (مثل /admin/order-details/5)
        if (preg_match('#^/admin/order-details/(\d+)$#', $path, $matches)) {
            $orderController->orderDetails($matches[1]);
        } 
        elseif (preg_match('#^/admin/order-details/user/(\d+)$#', $path, $matches)) {
            // جلب طلبات مستخدم معين من صفحة الـ Checks
            $userId = $matches[1];
            $fromDate = $_GET['from'] ?? date('Y-m-d', strtotime('-7 days'));
            $toDate = $_GET['to'] ?? date('Y-m-d');
            $orderController->userOrders($userId, $fromDate, $toDate);
        }
        else {
            abort(404);
        }
        break;
}

class OrderController {
    private $orderModel;
    
    public function __construct($db) {
        $this->orderModel = new Order($db);
    }
    
    // عرض صفحة الـ Checks مع الفلاتر
    public function checks() {
        $fromDate = $_GET['from_date'] ?? date('Y-m-d', strtotime('-7 days'));
        $toDate = $_GET['to_date'] ?? date('Y-m-d');
        $userId = $_GET['user_id'] ?? 'all';
        
        // جلب الطلبات حسب الفلاتر
        if ($userId === 'all') {
            $orders = $this->orderModel->getOrdersByDateRange($fromDate, $toDate);
        } else {
            $orders = $this->orderModel->getOrdersByDateAndUser($fromDate, $toDate, $userId);
        }
        
        // جلب قائمة المستخدمين للفلتر
        $users = $this->orderModel->getAllUsers();
        
        // تجهيز البيانات للتقرير
        $reportData = $this->prepareReportData($orders);
        
        // تحميل الـ View
        include 'views/orders/checks.php';
    }
    
    // عرض الطلبات الحالية
public function currentOrders() {
    $orders = $this->orderModel->getCurrentOrders();
    include 'views/orders/current-orders.php';  // ملف مستقل
}

// عرض طلبات مستخدم معين (للـ Drill-down)
public function userOrders($userId, $fromDate, $toDate) {
    $orders = $this->orderModel->getOrdersByDateAndUser($fromDate, $toDate, $userId);
    $userName = !empty($orders) ? $orders[0]['user_name'] : 'User';
    include 'views/orders/user-orders.php';  // ملف جديد منفصل
}


    
    // عرض طلبات مستخدم معين (للـ Drill-down)
    public function userOrders($userId, $fromDate, $toDate) {
        $orders = $this->orderModel->getOrdersByDateAndUser($fromDate, $toDate, $userId);
        $userName = !empty($orders) ? $orders[0]['user_name'] : 'User';
        include 'views/orders/user-orders.php';
    }
    
    // تحديث حالة الطلب (AJAX)
    public function updateStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = $_POST['order_id'] ?? null;
            $status = $_POST['status'] ?? null;
            
            if (!$orderId || !$status) {
                echo json_encode(['success' => false, 'message' => 'Missing data']);
                return;
            }
            
            $result = $this->orderModel->updateStatus($orderId, $status);
            
            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid status or update failed']);
            }
        }
    }
    
    // دالة مساعدة لتجهيز بيانات التقرير
    private function prepareReportData($orders) {
        $report = [];
        foreach ($orders as $order) {
            $userId = $order['user_id'];
            if (!isset($report[$userId])) {
                $report[$userId] = [
                    'user_name' => $order['user_name'],
                    'order_count' => 0,
                    'total_amount' => 0
                ];
            }
            $report[$userId]['order_count']++;
            $report[$userId]['total_amount'] += $order['total'] ?? 0;
        }
        return $report;
    }
}
?>