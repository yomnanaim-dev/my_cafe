<?php

$router->get('/', [HomeController::class, 'index']);


// Authentication
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'authenticate']);

$router->get('/register', [AuthController::class, 'register']);
$router->post('/register', [AuthController::class, 'store']);


// Products
$router->get('/products', [ProductController::class, 'index']);
$router->get('/products/details', [ProductController::class, 'details']);


// Cart
$router->get('/cart', [CartController::class, 'index']);
$router->post('/cart/add', [CartController::class, 'add']);


// Orders
$router->get('/orders', [OrderController::class, 'index']);
$router->get('/orders/history', [OrderController::class, 'history']);
$router->get('/orders/checkout', [OrderController::class, 'checkout']);


// Admin / Checks
$router->get('/admin/checks', [OrderController::class, 'checks']);
$router->get('/admin/current-orders', [OrderController::class, 'currentOrders']);

$router->post(
    '/admin/orders/update-status',
    [OrderController::class, 'updateStatus']
);