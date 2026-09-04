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
        return $status === 'pending';
    }

    public function getNextOrderId()
    {
        $result = $this->db->query(
            "SELECT COALESCE(MAX(order_id), 0) + 1 AS next_id FROM orders"
        );

        if (!$result) {
            return false;
        }

        $row = $result->fetch_assoc();

        return (int)$row['next_id'];
    }

    public function getNextItemId()
    {
        $result = $this->db->query(
            "SELECT COALESCE(MAX(item_id), 0) + 1 AS next_id FROM order_item"
        );

        if (!$result) {
            return false;
        }

        $row = $result->fetch_assoc();

        return (int)$row['next_id'];
    }

    public function createOrder(
        $orderId,
        $userId,
        $roomId,
        $note,
        $cart
    ) {
        if (empty($cart)) {
            return false;
        }

        $this->db->begin_transaction();

        try {

            $total = 0;
            $items = [];

            foreach ($cart as $productId => $item) {

                $productId = (int)$productId;

                $quantity = (int)(
                    $item['quantity']
                    ?? $item['qty']
                    ?? 1
                );

                if ($quantity <= 0) {
                    continue;
                }

                $stmt = $this->db->prepare("
                    SELECT product_id, product_price
                    FROM products
                    WHERE product_id = ?
                    AND product_available = 1
                ");

                $stmt->bind_param("i", $productId);
                $stmt->execute();

                $product = $stmt->get_result()->fetch_assoc();

                if (!$product) {
                    throw new Exception("Product not found");
                }

                $price = (float)$product['product_price'];

                $total += $price * $quantity;

                $items[] = [
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $price
                ];
            }

            if (empty($items) || $total <= 0) {
                throw new Exception("Cart is empty");
            }

            // Insert order
            $stmt = $this->db->prepare("
                INSERT INTO orders
                (
                    order_id,
                    order_total,
                    order_note,
                    order_status,
                    user_id,
                    room_id
                )
                VALUES (?, ?, ?, 'pending', ?, ?)
            ");

            $stmt->bind_param(
                "idsii",
                $orderId,
                $total,
                $note,
                $userId,
                $roomId
            );

            if (!$stmt->execute()) {
                throw new Exception("Order insert failed");
            }

            // Insert order items
            foreach ($items as $item) {

                $itemId = $this->getNextItemId();

                if (!$itemId) {
                    throw new Exception("Item ID failed");
                }

                $stmt = $this->db->prepare("
                    INSERT INTO order_item
                    (
                        item_id,
                        item_QTY,
                        price_at_order,
                        product_id,
                        order_id
                    )
                    VALUES (?, ?, ?, ?, ?)
                ");

                $stmt->bind_param(
                    "iidii",
                    $itemId,
                    $item['quantity'],
                    $item['price'],
                    $item['product_id'],
                    $orderId
                );

                if (!$stmt->execute()) {
                    throw new Exception("Order item insert failed");
                }
            }

            $this->db->commit();

            return true;

        } catch (Exception $e) {

            $this->db->rollback();

            return false;
        }
    }
}
?>
