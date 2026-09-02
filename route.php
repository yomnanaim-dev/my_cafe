<?php
// route.php

require_once 'config/database.php';
require_once 'controllers/OrderController.php';

// اتصال قاعدة البيانات
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// إنشاء Object من الـ Controller
$orderController = new OrderController($db);

// تحديد الـ URL
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// ===============================
// 1. Routes الثابتة (exact match)
// ===============================
$routes = [
    '/' => "controllers/index.php",
    '/about' => "controllers/about.php",
    '/contact' => "controllers/contact.php",
];

// ===============================
// 2. Routes الديناميكية (patterns)
// ===============================
$dynamicRoutes = [
    '#^/admin/checks$#' => ['controller' => $orderController, 'method' => 'checks'],
    '#^/admin/current-orders$#' => ['controller' => $orderController, 'method' => 'currentOrders'],
    '#^/admin/update-status$#' => ['controller' => $orderController, 'method' => 'updateStatus'],
    '#^/admin/order-details/(\d+)$#' => ['controller' => $orderController, 'method' => 'orderDetails'],
    '#^/admin/order-details/user/(\d+)$#' => ['controller' => $orderController, 'method' => 'userOrders'],
];

// ===============================
// دالة الـ Routing
// ===============================
function abort($code = 404) {
    http_response_code($code);
    require "views/{$code}.php";
    die();
}

function routeToControllers($url, $routes, $dynamicRoutes) {
    // 1. البحث في الـ Routes الثابتة
    if (array_key_exists($url, $routes)) {
        require $routes[$url];
        return;
    }
    
    // 2. البحث في الـ Routes الديناميكية
    foreach ($dynamicRoutes as $pattern => $route) {
        if (preg_match($pattern, $url, $matches)) {
            // استدعاء الدالة المناسبة في الـ Controller
            $controller = $route['controller'];
            $method = $route['method'];
            
            // لو فيه Parameters, نمررهم للدالة
            $params = array_slice($matches, 1); // أول عنصر هو النص الكامل،