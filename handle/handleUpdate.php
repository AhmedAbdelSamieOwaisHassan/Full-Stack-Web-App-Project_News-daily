<?php

require_once __DIR__.'/../inc/connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_GET['id'])) {
    header('Location: ../index.php');
    exit;
}

$errors = [];
$id = (int) $_GET['id'];
$badge = trim($_POST['badge'] ?? '');
$title = trim($_POST['title'] ?? '');
$body = trim($_POST['body'] ?? '');

if (empty($badge)) {
    $errors[] = 'The badge should be Exist ';
}
if (empty($title)) {
    $errors[] = 'The title should be Exist ';
}
if (empty($body)) {
    $errors[] = 'The body should be Exist ';
}

$query = 'SELECT image FROM posts WHERE id = ?';
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$post = mysqli_fetch_assoc($result);
$oldImage = $post['image'] ?? '';
$img_new_name = $oldImage;
$img_tnp_name = '';

if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
    $img = $_FILES['image'];
    $img_name = $img['name'];
    $img_tnp_name = $img['tmp_name'];
    $img_error = $img['error'] ?? 0;
    $img_size = isset($img['size']) ? $img['size'] / (1024 * 1024) : 0;
    $ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
    $img_new_name = uniqid('', true).'.'.$ext;

    if (empty($img_name)) {
        $errors[] = 'image should be Exist';
    } elseif ($img_error > 0) {
        $errors[] = 'your File is Broken';
    } elseif (!in_array($ext, ['png', 'jpg', 'jpeg'])) {
        $errors[] = 'image should be jpg or png';
    } elseif ($img_size > 5) {
        $errors[] = 'image should be less than 2mb';
    }
}

if (empty($errors)) {
    $query = 'UPDATE posts SET badge = ?, title = ?, body = ?, image = ? WHERE id = ?';
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'ssssi', $badge, $title, $body, $img_new_name, $id);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        $_SESSION['success'] = 'the post is updated successfully ✔';

        if (!empty($img_tnp_name) && file_exists($img_tnp_name)) {
            $targetPath = __DIR__.'/../assets/image/postImage/'.$img_new_name;
            move_uploaded_file($img_tnp_name, $targetPath);

            if (!empty($oldImage) && $oldImage !== $img_new_name) {
                $oldImagePath = __DIR__.'/../assets/image/postImage/'.$oldImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }

        header('Location: ../index.php');
        exit;
    }

    $errors[] = 'Update failed: '.mysqli_error($connection);
}

$_SESSION['errors'] = $errors;
header('Location: ../aditPost.php?id='.$id);
exit;
