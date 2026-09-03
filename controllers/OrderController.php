<?php

require "views/orders/manual_order.php";

// controllers/OrderController.php

require_once 'models/Order.php';

class OrderController {
    private $orderModel;
    
    public function __construct($db) {
        $this->orderModel = new Order($db);
    }
    
    public function currentOrders() {
        $orders = $this->orderModel->getCurrentOrders();
        
        // إضافة تفاصيل المنتجات لكل طلب
        foreach ($orders as &$order) {
            $order['items'] = $this->orderModel->getOrderItems($order['order_id']);
        }
        
        include 'views/orders/current-orders.php';
    }
    
    public function checks() {
        $fromDate = $_GET['from_date'] ?? date('Y-m-d', strtotime('-7 days'));
        $toDate = $_GET['to_date'] ?? date('Y-m-d');
        $userId = $_GET['user_id'] ?? 'all';
        
        if ($userId === 'all') {
            $orders = $this->orderModel->getOrdersByDateAndUser($fromDate, $toDate);
        } else {
            $orders = $this->orderModel->getOrdersByDateAndUser($fromDate, $toDate, $userId);
        }
        
        $users = $this->orderModel->getAllUsers();
        $reportData = $this->prepareReportData($orders);
        
        include 'views/orders/checks.php';
    }
    
    public function userOrders($userId, $fromDate, $toDate) {
        $orders = $this->orderModel->getOrdersByDateAndUser($fromDate, $toDate, $userId);
        $userName = !empty($orders) ? $orders[0]['user_name'] : 'User';
        include 'views/orders/user-orders.php';
    }
    
    public function orderDetails($orderId) {
        $order = $this->orderModel->getOrderById($orderId);
        $items = $this->orderModel->getOrderItems($orderId);
        include 'views/orders/order-details.php';
    }
    
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
            $report[$userId]['total_amount'] += $order['order_total'] ?? 0;
        }
        return $report;
    }
}
?>
