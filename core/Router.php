<?php

namespace Core;


class Router
{
    protected $routes = [];

    public function get($url, $controller)
    {
        $this->routes[] = [
            "url"        => $url,
            "controller" => $controller,
            "method"     => "GET"
        ];
    }

    public function post($url, $controller)
    {
        $this->routes[] = [
            "url"        => $url,
            "controller" => $controller,
            "method"     => "POST"
        ];
    }

    public function delete($url, $controller)
    {
        $this->routes[] = [
            "url"        => $url,
            "controller" => $controller,
            "method"     => "DELETE"
        ];
    }

    public function put($url, $controller)
    {
        $this->routes[] = [
            "url"        => $url,
            "controller" => $controller,
            "method"     => "PUT"
        ];
    }

    public function patch($url, $controller)
    {
        $this->routes[] = [
            "url"        => $url,
            "controller" => $controller,
            "method"     => "PATCH"
        ];
    }

    public function route($url, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['url'] === $url && $route['method'] === strtoupper($method)) {
                return require base_path($route['controller']);
            }
        }

        $this->abort();
    }

    protected function abort($code = Response::NOT_FOUND)
    {
        http_response_code($code);
        require base_path("views/errors/{$code}.php");
        die();
    }
}
