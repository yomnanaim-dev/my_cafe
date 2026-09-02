<?php

require_once BASE_PATH . '/models/User.php';

$userModel = new User();
$url = parse_url($_SERVER['REQUEST_URI'])['path'];
$id = $_GET['id'] ?? null;


if ($url === '/users' || $url === '/') {
    $users = $userModel->getAll();
    require_once BASE_PATH . '/views/users/users.php';
    exit;
}

if ($url === '/add-user') {
    $user = $id ? $userModel->find((int)$id) : null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'user_name'  => trim($_POST['name'] ?? ''),
            'user_email' => trim($_POST['email'] ?? ''),
            'room_id'    => $_POST['room_no'] ?? null,
            'ext'        => trim($_POST['ext'] ?? '')
        ];

        if (!empty($_POST['password'])) {
            $data['user_password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }

       
        if (!empty($_FILES['profile_pic']['name']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
            $imgName = time() . '_' . basename($_FILES['profile_pic']['name']);
            $relativePath = 'public/images/' . $imgName;
            $absolutePath = BASE_PATH . '/' . $relativePath;

            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $absolutePath)) {
               
                if ($user && !empty($user['user_image'])) {
                    $oldPath = BASE_PATH . '/' . $user['user_image'];
                    if (file_exists($oldPath) && is_file($oldPath)) {
                        unlink($oldPath);
                    }
                }
                $data['user_image'] = $relativePath;
            }
        }

        $id ? $userModel->update((int)$id, $data) : $userModel->create($data);

        header('Location: /users');
        exit;
    }

    $db = (new Database())->connect();
    $rooms = $db->query("SELECT * FROM room")->fetchAll();

    require_once BASE_PATH . '/views/users/add_user.php';
    exit;
}


if ($url === '/delete-user' && $id) {
    $userModel->delete((int)$id);
    header('Location: /users');
    exit;
}