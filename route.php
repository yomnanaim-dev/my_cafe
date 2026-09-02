<?php

// routes/web.php أو route.php

// Routes الخاصة بـ Merna (Admin Orders)
$router->addRoute('/admin/checks', 'OrderController', 'checks');
$router->addRoute('/admin/current-orders', 'OrderController', 'currentOrders');
$router->addRoute('/admin/order-details/(\d+)', 'OrderController', 'orderDetails');
$router->addRoute('/admin/update-status', 'OrderController', 'updateStatus');





$url = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/' => "controllers/index.php",
    '/about' => "controllers/about.php",
    '/contact' => "controllers/contact.php",
];

function abort($code = 404)
{
    http_response_code($code);

    require "views/{$code}.php";
    die();
}

function routeToControllers($url, $routes)
{
    if (array_key_exists($url, $routes)) {
        require $routes[$url];
    } else {
        abort(404);
    }
}

routeToControllers($url, $routes);