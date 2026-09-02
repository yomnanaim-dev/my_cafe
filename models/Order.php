<?php
// models/Order.php

class Order {
    private $db;
    
    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }
    
    // 1. جلب كل الطلبات مع بيانات المستخدمين
    public function getAllOrders() {
        $query = "SELECT orders.*, users.name as user_name 
                  FROM orders 
                  JOIN users ON orders.user_id = users.id 
                  ORDER BY orders.order_date DESC";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    // 2. جلب الطلبات حسب نطاق تاريخي
    public function getOrdersByDateRange($fromDate, $toDate) {
        $query = "SELECT orders.*, users.name as user_name 
                  FROM orders 
                  JOIN users ON orders.user_id = users.id 
                  WHERE DATE(orders.order_date) BETWEEN ? AND ?
                  ORDER BY orders.order_date DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $fromDate, $toDate);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    // 3. جلب الطلبات حسب مستخدم معين
    public function getOrdersByUser($userId) {
        $query = "SELECT orders.*, users.name as user_name 
                  FROM orders 
                  JOIN users ON orders.user_id = users.id 
                  WHERE orders.user_id = ?
                  ORDER BY orders.order_date DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    // 4. جلب الطلبات حسب التاريخ والمستخدم (فلترة مزدوجة)
    public function getOrdersByDateAndUser($fromDate, $toDate, $userId = null) {
        $query = "SELECT orders.*, users.name as user_name 
                  FROM orders 
                  JOIN users ON orders.user_id = users.id 
                  WHERE DATE(orders.order_date) BETWEEN ? AND ?";
        
        $params = [$fromDate, $toDate];
        $types = "ss";
        
        if ($userId !== null && $userId !== 'all') {
            $query .= " AND orders.user_id = ?";
            $params[] = $userId;
            $types .= "i";
        }
        
        $query .= " ORDER BY orders.order_date DESC";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    // 5. جلب الطلبات الحالية (غير المكتملة)
    public function getCurrentOrders() {
        $query = "SELECT orders.*, users.name as user_name 
                  FROM orders 
                  JOIN users ON orders.user_id = users.id 
                  WHERE orders.status != 'Done'
                  ORDER BY orders.order_date DESC";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    // 6. جلب طلب محدد بالـ ID
    public function getOrderById($orderId) {
        $query = "SELECT orders.*, users.name as user_name 
                  FROM orders 
                  JOIN users ON orders.user_id = users.id 
                  WHERE orders.id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    // 7. جلب تفاصيل المنتجات في طلب معين
    public function getOrderItems($orderId) {
        $query = "SELECT order_items.*, products.name as product_name 
                  FROM order_items 
                  JOIN products ON order_items.product_id = products.id 
                  WHERE order_items.order_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    // 8. تحديث حالة الطلب (مع التحقق من الصلاحية)
    public function updateStatus($orderId, $status) {
        // التحقق من أن الحالة مسموح بها
        $allowedStatuses = ['Processing', 'Out for Delivery', 'Done'];
        if (!in_array($status, $allowedStatuses)) {
            return false;
        }
        
        $query = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $status, $orderId);
        return $stmt->execute();
    }
    
    // 9. جلب جميع المستخدمين (للقائمة المنسدلة)
    public function getAllUsers() {
        $query = "SELECT id, name FROM users ORDER BY name";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>