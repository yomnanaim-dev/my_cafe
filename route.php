<?php



$url = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/' => "controllers/index.php",
    '/about' => "controllers/about.php",
    '/contact' => "controllers/contact.php",
    '/manual-order' => "controllers/OrderController.php",
    '/users' => "controllers/UserController.php",
    '/add-user' => "controllers/UserController.php",
   
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