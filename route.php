<?php

define('BASE_PATH', __DIR__);

require_once BASE_PATH . '/config/Database.php';

$url = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/'             => "controllers/UserController.php",
    '/users'        => "controllers/UserController.php",
    '/add-user'     => "controllers/UserController.php",
    '/manual-order' => "controllers/OrderController.php",
    '/delete-user'  => "controllers/UserController.php",
];

function abort($code = 404) {
    http_response_code($code);
    require_once BASE_PATH . "/views/{$code}.php";
    die();
}

function routeToControllers($url, $routes) {
    if (array_key_exists($url, $routes)) {
        require_once BASE_PATH . '/' . $routes[$url];
    } else {
        abort(404);
    }
}

routeToControllers($url, $routes);