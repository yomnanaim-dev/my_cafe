<?php

require_once __DIR__ . '/functions.php';

$url = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

// Normalize URL (strip trailing slashes, script filename if present)
$scriptDir = dirname($_SERVER['SCRIPT_NAME'] ?? '');
if ($scriptDir !== '/' && $scriptDir !== '\\' && strpos($url, $scriptDir) === 0) {
    $url = substr($url, strlen($scriptDir));
}
$url = '/' . ltrim($url, '/');
if (strlen($url) > 1) {
    $url = rtrim($url, '/');
}

$routes = [
    '/' => 'controllers/index.php',
    '/products' => 'controllers/ProductController.php',
    '/menu' => 'controllers/ProductController.php',
    '/admin' => 'controllers/AdminController.php',
    '/admin/menu' => 'controllers/AdminController.php',
    '/admin/products' => 'controllers/AdminController.php',
    '/about' => 'controllers/about.php',
    '/contact' => 'controllers/contact.php',
];

function abort($code = 404)
{
    http_response_code($code);
    $viewPath = base_path("views/{$code}.php");
    if (file_exists($viewPath)) {
        require $viewPath;
    } else {
        echo "<h1>{$code} - Page Not Found</h1>";
    }
    die();
}

function routeToControllers($url, $routes)
{
    if (array_key_exists($url, $routes)) {
        $controllerPath = base_path($routes[$url]);
        if (file_exists($controllerPath)) {
            require $controllerPath;
            return;
        }
    }
    abort(404);
}

routeToControllers($url, $routes);