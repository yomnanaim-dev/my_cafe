<?php
// route.php

$url = parse_url($_SERVER['REQUEST_URI'])['path'];

// 1. Routes الثابتة (exact match)
$routes = [
    '/' => "controllers/index.php",
    '/about' => "controllers/about.php",
    '/contact' => "controllers/contact.php",
    '/admin/checks' => "controllers/OrderController.php",
    '/admin/current-orders' => "controllers/OrderController.php",
    '/admin/update-status' => "controllers/OrderController.php",
];

// 2. Routes الديناميكية (patterns)
$dynamicRoutes = [
    '#^/admin/order-details/(\d+)$#' => "controllers/OrderController.php",  // /admin/order-details/5
    '#^/admin/order-details/user/(\d+)$#' => "controllers/OrderController.php", // /admin/order-details/user/3
];

function abort($code = 404)
{
    http_response_code($code);
    require "views/{$code}.php";
    die();
}

function routeToControllers($url, $routes, $dynamicRoutes)
{
    // 1. البحث في الـ Routes الثابتة
    if (array_key_exists($url, $routes)) {
        require $routes[$url];
        return;
    }
    
    // 2. البحث في الـ Routes الديناميكية
    foreach ($dynamicRoutes as $pattern => $controller) {
        if (preg_match($pattern, $url, $matches)) {
            // تخزين الـ parameters في متغير عام
            $GLOBALS['route_params'] = $matches;
            require $controller;
            return;
        }
    }
    
    // 3. لو مفيش Route match
    abort(404);
}

routeToControllers($url, $routes, $dynamicRoutes);