<?php


// models/Order.php

class Order {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function getCurrentOrders() {
        $query = "SELECT orders.*, users.user_name, users.room_id, room.room_number
                  FROM orders 
                  JOIN users ON orders.user_id = users.user_id 
                  LEFT JOIN room ON users.room_id = room.room_id
                  WHERE orders.order_status != 'completed'
                  ORDER BY orders.order_created_at DESC";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getOrdersByDateAndUser($fromDate, $toDate, $userId = null) {
        $query = "SELECT orders.*, users.user_name
                  FROM orders 
                  JOIN users ON orders.user_id = users.user_id 
                  WHERE DATE(orders.order_created_at) BETWEEN ? AND ?";
        
        $params = [$fromDate, $toDate];
        $types = "ss";
        
        if ($userId !== null && $userId !== 'all') {
            $query .= " AND orders.user_id = ?";
            $params[] = $userId;
            $types .= "i";
        }
        
        $query .= " ORDER BY orders.order_created_at DESC";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getOrderById($orderId) {
        $query = "SELECT orders.*, users.user_name, users.room_id, room.room_number
                  FROM orders 
                  JOIN users ON orders.user_id = users.user_id 
                  LEFT JOIN room ON users.room_id = room.room_id
                  WHERE orders.order_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    public function getOrderItems($orderId) {
        // تصحيح: اسم الجدول هو order_item (مفرد) مش order_items (جمع)
        $query = "SELECT order_item.*, products.product_name, products.product_price
                  FROM order_item 
                  JOIN products ON order_item.product_id = products.product_id 
                  WHERE order_item.order_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function updateStatus($orderId, $status) {
        $allowedStatuses = ['pending', 'confirmed', 'completed', 'cancelled'];
        if (!in_array(strtolower($status), $allowedStatuses)) {
            return false;
        }
        
        $query = "UPDATE orders SET order_status = ? WHERE order_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $status, $orderId);
        return $stmt->execute();
    }
    
    public function getAllUsers() {
        $query = "SELECT user_id, user_name FROM users ORDER BY user_name";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function canCancel($status)
    {
        return $status === "Processing";
    }
}
?>
