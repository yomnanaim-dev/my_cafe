<?php
// controllers/OrderController.php

require_once 'models/Order.php';

class OrderController {
    private $orderModel;
    
    public function __construct($db) {
        $this->orderModel = new Order($db);
    }
    
    // 1. صفحة التقرير مع الفلاتر
    public function checks() {
        $fromDate = $_GET['from_date'] ?? date('Y-m-d', strtotime('-7 days'));
        $toDate = $_GET['to_date'] ?? date('Y-m-d');
        $userId = $_GET['user_id'] ?? 'all';
        
        if ($userId === 'all') {
            $orders = $this->orderModel->getOrdersByDateRange($fromDate, $toDate);
        } else {
            $orders = $this->orderModel->getOrdersByDateAndUser($fromDate, $toDate, $userId);
        }
        
        $users = $this->orderModel->getAllUsers();
        $reportData = $this->prepareReportData($orders);
        
        include 'views/orders/checks.php';
    }
    
    // 2. الطلبات الحالية (كل المستخدمين)
    public function currentOrders() {
        $orders = $this->orderModel->getCurrentOrders();
        include 'views/orders/current-orders.php';
    }
    
    // 3. طلبات مستخدم معين (Drill-down)
    public function userOrders($userId, $fromDate, $toDate) {
        $orders = $this->orderModel->getOrdersByDateAndUser($fromDate, $toDate, $userId);
        $userName = !empty($orders) ? $orders[0]['user_name'] : 'User';
        include 'views/orders/user-orders.php';
    }
    
    // 4. تفاصيل طلب معين
    public function orderDetails($orderId) {
        $order = $this->orderModel->getOrderById($orderId);
        $items = $this->orderModel->getOrderItems($orderId);
        include 'views/orders/order-details.php';
    }
    
    // 5. تحديث الحالة (AJAX)
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
    
    // دالة مساعدة لتجهيز التقرير
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