<?php

require_once __DIR__.'/../inc/connection.php';

if (!isset($connection) || !$connection) {
    $_SESSION['errors'] = ['Database connection is not available.'];
    header('Location: ../addPost.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    $badge = $_POST['badge'] ?? '';
    $title = $_POST['title'] ?? '';
    $body = $_POST['body'] ?? '';

    if (empty($badge)) {
        $errors[] = 'The badge should be Exist ';
    }
    if (empty($title)) {
        $errors[] = 'The title should be Exist ';
    }
    if (empty($body)) {
        $errors[] = 'The body should be Exist ';
    }
    $current_time = date('y-mm-DDDD H:i:s');
    $img = $_FILES['image'] ?? [];
    $img_name = $img['name'] ?? '';
    $img_tnp_name = $img['tmp_name'] ?? '';
    $img_error = $img['error'] ?? 0;
    $img_size = isset($img['size']) ? $img['size'] / (1024 * 1024) : 0;
    $ext = !empty($img_name) ? strtolower(pathinfo($img_name, PATHINFO_EXTENSION)) : '';
    $img_new_name = !empty($img_name) ? uniqid().'.'.$ext : '';

    if (empty($img_name)) {
        $errors[] = 'image  should be Exist ';
    } elseif ($img_error > 0) {
        $errors[] = 'your File is Broken';
    } elseif (!in_array($ext, ['png', 'jpg', 'jpeg'])) {
        $errors[] = 'image should be jpg or png';
    } elseif ($img_size > 5) {
        $errors[] = 'image should be less than 2mb';
    }

    if (empty($errors)) {
        $badgeColumn = mysqli_query($connection, "SHOW COLUMNS FROM posts LIKE 'badge'");
        if (mysqli_num_rows($badgeColumn) === 0) {
            mysqli_query($connection, "ALTER TABLE posts ADD COLUMN badge VARCHAR(100) NOT NULL DEFAULT 'General' AFTER title");
        }

        $query = 'INSERT INTO posts (`badge`, `title`, `body`, `image`, `user_id`, `created_at`) VALUES (?, ?, ?, ?, 1, NOW())';
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, 'ssss', $badge, $title, $body, $img_new_name);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            $_SESSION['success'] = 'the post is inserted successfully ✔';
            move_uploaded_file($img_tnp_name, '../assets/image/postImage/'.$img_new_name);
            header('location:../index.php');
            exit;
        }

        $_SESSION['errors'] = ['Insert failed: '.mysqli_error($connection)];
        header('location:../addPost.php');
        exit;
    }

    $_SESSION['errors'] = $errors;
    header('location:../addPost.php');
    exit;
}
