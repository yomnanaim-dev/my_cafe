<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

if ($uri === '/add-user') {
    require_once __DIR__ . '/../views/users/add_user.php';
} else {
    require_once __DIR__ . '/../views/users/users.php';
}