<?php

require_once __DIR__ . '/functions.php';

// Check query parameter routing first (e.g. ?page=products or ?page=admin)
$page = $_GET['page'] ?? null;

if ($page) {
    switch ($page) {
        case 'products':
        case 'menu':
            require base_path('controllers/ProductController.php');
            exit;
        case 'admin':
        case 'admin-menu':
            require base_path('controllers/AdminController.php');
            exit;
        case 'home':
            require base_path('controllers/index.php');
            exit;
        default:
            require base_path('controllers/index.php');
            exit;
    }
}

// Otherwise execute router
require __DIR__ . '/route.php';
