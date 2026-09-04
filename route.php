<?php

require_once 'config/database.php';
require_once 'controllers/OrderController.php';

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$orderController = new OrderController($db);


// =============================================
// تحديد URL
// =============================================

$url = $_SERVER['REQUEST_URI'];
if (isset($_GET['route'])) {
    $url = '/' . trim($_GET['route'], '/');
}

$basePath = '/my_cafe';

if (strpos($url, $basePath) === 0) {
    $url = substr($url, strlen($basePath));
}

if (strpos($url, '?') !== false) {
    $url = substr($url, 0, strpos($url, '?'));
}

if ($url !== '' && $url[0] !== '/') {
    $url = '/' . $url;
}

if (empty($url)) {
    $url = '/';
}


// =============================================
// الصفحة الرئيسية
// =============================================

if ($url === '/' || $url === '/index.php') {
    require 'views/home/index.php';
    exit;
}


// =============================================
// Routes
// =============================================

switch ($url) {

    // =========================================
    // Admin Orders
    // =========================================

    case '/admin/current-orders':

        $orderController->currentOrders();

        break;


    case '/admin/checks':

        $orderController->checks();

        break;


    case '/admin/update-status':

        $orderController->updateStatus();

        break;


    // =========================================
    // My Orders
    // =========================================

 case '/my-orders':

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $userId = $_SESSION['user_id'] ?? null;

    if (!$userId) {
        echo "Please login first";
        break;
    }

    $fromDate = $_GET['from'] ?? null;
    $toDate = $_GET['to'] ?? null;

    $orderController->myOrders(
        $userId,
        $fromDate,
        $toDate
    );

    break;
    // =========================================
    // My Order Details
    // =========================================

    case '/my-order-details':

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userId = $_SESSION['user_id'] ?? null;
        $orderId = $_GET['id'] ?? null;

        if (!$userId) {
            echo "Please login first";
            break;
        }

        if (!$orderId || !is_numeric($orderId)) {
            echo "Invalid order ID";
            break;
        }

        $orderController->myOrderDetails(
            (int)$orderId,
            (int)$userId
        );

        break;


    // =========================================
    // Cancel My Order
    // =========================================

    case '/cancel-my-order':

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Invalid request";
            break;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userId = $_SESSION['user_id'] ?? null;
        $orderId = $_POST['order_id'] ?? null;

        if (!$userId) {
            echo "Please login first";
            break;
        }

        if (!$orderId || !is_numeric($orderId)) {
            echo "Invalid order ID";
            break;
        }

        $orderController->cancelMyOrder(
            (int)$orderId,
            (int)$userId
        );

        break;
       case '/place-order':

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $userId = $_SESSION['user_id'] ?? null;

    if (!$userId) {
        echo "Please login first";
        break;
    }

    $orderController->placeOrder((int)$userId);
    break;

    // =========================================
    // Admin Order Details
    // =========================================

    default:

        // /admin/order-details/{id}

        if (strpos($url, '/admin/order-details/') === 0) {

            $parts = explode('/', $url);
            $orderId = end($parts);

            if (is_numeric($orderId)) {

                $orderController->orderDetails(
                    (int)$orderId
                );

            } else {

                echo "Invalid order ID";
            }
        }


        // /admin/order-details/user/{id}

        elseif (
            strpos(
                $url,
                '/admin/order-details/user/'
            ) === 0
        ) {

            $parts = explode('/', $url);
            $userId = end($parts);

            if (is_numeric($userId)) {

                $fromDate = $_GET['from']
                    ?? date(
                        'Y-m-d',
                        strtotime('-7 days')
                    );

                $toDate = $_GET['to']
                    ?? date('Y-m-d');

                $orderController->userOrders(
                    (int)$userId,
                    $fromDate,
                    $toDate
                );

            } else {

                echo "Invalid user ID";
            }
        }


        // 404

        else {

            http_response_code(404);

            echo "<h1>404 - Page Not Found</h1>";
            echo "<p>The URL <strong>"
                . htmlspecialchars($url)
                . "</strong> does not exist.</p>";

            echo "<p>
                    <a href='/my_cafe/'>
                        Go Home
                    </a>
                  </p>";
        }

        break;
}