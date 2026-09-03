<?php

function dd($value)
{
    if (is_array($value) || is_object($value)) {
        echo "<h2><pre>";
        var_dump($value);
        echo "</pre></h2>";
    } else {
        echo $value;
    }
    die();
}

function urlIs($value)
{
    $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    return $uri === $value;
}

function base_path($path = '')
{
    return __DIR__ . ($path ? DIRECTORY_SEPARATOR . ltrim($path, '/\\') : '');
}

function view($path, $data = [])
{
    extract($data);
    $viewPath = base_path("views/{$path}.php");
    if (file_exists($viewPath)) {
        require $viewPath;
    } else {
        echo "View not found: views/{$path}.php";
    }
}

function asset($path)
{
    $cleanPath = ltrim($path, '/');
    // If public/ exists in path
    if (file_exists(base_path("public/{$cleanPath}"))) {
        return "public/{$cleanPath}";
    }
    return $cleanPath;
}
