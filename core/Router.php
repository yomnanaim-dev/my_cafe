<?php

class Router
{
    private array $routes = [];

    public function get(string $uri, array $action)
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function post(string $uri, array $action)
    {
        $this->routes['POST'][$uri] = $action;
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Remove project folder from URL
        $basePath = '/cafeteria/public';

        if (str_starts_with($uri, $basePath)) {
            $uri = substr($uri, strlen($basePath));
        }

        if ($uri === '') {
            $uri = '/';
        }

        if (isset($this->routes[$method][$uri])) {

            [$controller, $function] =
                $this->routes[$method][$uri];

            $controllerInstance = new $controller();

            return $controllerInstance->$function();
        }

        http_response_code(404);

        echo "404 - Page Not Found";
    }
}