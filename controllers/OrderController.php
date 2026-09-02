<?php
// controllers/OrderController.php

require_once 'models/Order.php';

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
        include 'views/orders/current-orders.php';
    }
    
    // عرض تفاصيل طلب معين
    public function orderDetails($orderId) {
        $order = $this->orderModel->getOrderById($orderId);
        $items = $this->orderModel->getOrderItems($orderId);
        include 'views/orders/order-details.php';
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