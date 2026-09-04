<?php

class Order
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getUserOrders($userId, $fromDate = null, $toDate = null)
    {
        $sql = "
            SELECT o.*, r.room_number
            FROM orders o
            LEFT JOIN room r ON o.room_id = r.room_id
            WHERE o.user_id = ?
        ";

        $params = [$userId];
        $types = "i";

        if ($fromDate) {
            $sql .= " AND DATE(o.order_created_at) >= ?";
            $params[] = $fromDate;
            $types .= "s";
        }

        if ($toDate) {
            $sql .= " AND DATE(o.order_created_at) <= ?";
            $params[] = $toDate;
            $types .= "s";
        }

        $sql .= " ORDER BY o.order_created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrderItems($orderId)
    {
        $sql = "
            SELECT
                oi.item_QTY,
                oi.price_at_order,
                p.product_name
            FROM order_item oi
            JOIN products p ON oi.product_id = p.product_id
            WHERE oi.order_id = ?
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $orderId);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserOrderById($orderId, $userId)
    {
        $sql = "
            SELECT o.*, r.room_number
            FROM orders o
            LEFT JOIN room r ON o.room_id = r.room_id
            WHERE o.order_id = ?
            AND o.user_id = ?
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $orderId, $userId);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function cancelOrder($orderId, $userId)
    {
        $sql = "
            UPDATE orders
            SET order_status = 'cancelled'
            WHERE order_id = ?
            AND user_id = ?
            AND order_status = 'pending'
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $orderId, $userId);

        return $stmt->execute();
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