<?php

require_once 'models/Order.php';

class OrderController
{
    private $orderModel;

    public function __construct($db)
    {
        $this->orderModel = new Order($db);
    }

    // =========================
    // Admin
    // =========================

    public function currentOrders()
    {
        $orders = $this->orderModel->getCurrentOrders();

        foreach ($orders as &$order) {
            $order['items'] =
                $this->orderModel->getOrderItems($order['order_id']);
        }

        include 'views/orders/current-orders.php';
    }

    public function checks()
    {
        $fromDate = $_GET['from_date']
            ?? date('Y-m-d', strtotime('-7 days'));

        $toDate = $_GET['to_date']
            ?? date('Y-m-d');

        $userId = $_GET['user_id'] ?? 'all';

        if ($userId === 'all') {
            $orders =
                $this->orderModel->getOrdersByDateAndUser(
                    $fromDate,
                    $toDate
                );
        } else {
            $orders =
                $this->orderModel->getOrdersByDateAndUser(
                    $fromDate,
                    $toDate,
                    $userId
                );
        }

        $users = $this->orderModel->getAllUsers();

        $reportData =
            $this->prepareReportData($orders);

        include 'views/orders/checks.php';
    }

    public function userOrders($userId, $fromDate, $toDate)
    {
        $orders =
            $this->orderModel->getOrdersByDateAndUser(
                $fromDate,
                $toDate,
                $userId
            );

        $userName =
            !empty($orders)
            ? $orders[0]['user_name']
            : 'User';

        include 'views/orders/user-orders.php';
    }

    public function orderDetails($orderId)
    {
        $order =
            $this->orderModel->getOrderById($orderId);

        $items =
            $this->orderModel->getOrderItems($orderId);

        include 'views/orders/order-details.php';
    }

    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $orderId = $_POST['order_id'] ?? null;
        $status = $_POST['status'] ?? null;

        if (!$orderId || !$status) {
            echo json_encode([
                'success' => false,
                'message' => 'Missing data'
            ]);
            return;
        }

        $result =
            $this->orderModel->updateStatus(
                $orderId,
                $status
            );

        if ($result) {
            echo json_encode([
                'success' => true
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid status or update failed'
            ]);
        }
    }

    // =========================
    // My Orders
    // =========================

    public function myOrders(
        $userId,
        $fromDate = null,
        $toDate = null
    ) {
        $orders =
            $this->orderModel->getUserOrders(
                $userId,
                $fromDate,
                $toDate
            );

        foreach ($orders as &$order) {
            $order['items'] =
                $this->orderModel->getOrderItems(
                    $order['order_id']
                );
        }

        include 'views/orders/cart.php';
    }

    public function myOrderDetails(
        $orderId,
        $userId
    ) {
        $order =
            $this->orderModel->getUserOrderById(
                $orderId,
                $userId
            );

        if (!$order) {
            echo "Order not found";
            return;
        }

        $items =
            $this->orderModel->getOrderItems(
                $orderId
            );

        include 'views/orders/cart.php';
    }

    public function cancelMyOrder(
        $orderId,
        $userId
    ) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request";
            return;
        }

        $result =
            $this->orderModel->cancelOrder(
                $orderId,
                $userId
            );

        if ($result) {
            header("Location: /my_cafe/my-orders");
            exit;
        }

        echo "Order cannot be cancelled";
    }

    private function prepareReportData($orders)
    {
        $report = [];

        foreach ($orders as $order) {

            $userId = $order['user_id'];

            if (!isset($report[$userId])) {
                $report[$userId] = [
                    'user_name' =>
                        $order['user_name'],

                    'order_count' => 0,

                    'total_amount' => 0
                ];
            }

            $report[$userId]['order_count']++;

            $report[$userId]['total_amount'] +=
                $order['order_total'] ?? 0;
        }

        return $report;
    }
      public function placeOrder($userId)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo "Invalid request";
        return;
    }

    $roomId = $_POST['room_id'] ?? null;
    $note = trim($_POST['note'] ?? '');

    if (!$roomId) {
        echo "Please select a room";
        return;
    }

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $cart = $_SESSION['cart'] ?? [];

    if (empty($cart)) {
        echo "Your cart is empty";
        return;
    }

    $orderId = $this->orderModel->getNextOrderId();

    if (!$orderId) {
        echo "Could not create order ID";
        return;
    }

    $result = $this->orderModel->createOrder(
        $orderId,
        (int)$userId,
        (int)$roomId,
        $note,
        $cart
    );

    if ($result) {

        // Clear cart after successful order
        $_SESSION['cart'] = [];

        header("Location: /my_cafe/index.php?route=my-orders");
        exit;
    }

    echo "Failed to place order";
}
}