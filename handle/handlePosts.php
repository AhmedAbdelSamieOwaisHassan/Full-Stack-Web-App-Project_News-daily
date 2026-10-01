<?php

require_once __DIR__ . '/../inc/connection.php';

if (!isset($connection) || !$connection) {$_SESSION['errors'] = ['Database connection is not available.'];
    header('Location: /addPost.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {$errors = [];
    $badge = trim($_POST['badge'] ?? '');
    $title = trim($_POST['title'] ?? '');
    $body  = trim($_POST['body'] ?? '');

    if (empty($badge)) {$errors[] = 'The badge is required.';
    }
    if (empty($title)) {$errors[] = 'The title is required.';
    }
    if (empty($body)) {$errors[] = 'The body is required.';
    }

    $img          =$_FILES['image'] ?? [];
    $img_name     =$img['name'] ?? '';
    $img_tmp_name =$img['tmp_name'] ?? '';
    $img_error    =$img['error'] ?? 0;
    $img_size     = isset($img['size']) ?$img['size'] / (1024 * 1024) : 0;
    $ext          = !empty($img_name) ? strtolower(pathinfo($img_name, PATHINFO_EXTENSION)) : '';$img_new_name = !empty($img_name) ? uniqid() . '.' . $ext : 'NewsDaily.jpg';

    if (empty($img_name)) {$errors[] = 'An image is required.';
    } elseif ($img_error > 0) {$errors[] = 'Your image file is corrupted or broken.';
    } elseif (!in_array($ext, ['png', 'jpg', 'jpeg', 'webp'])) {$errors[] = 'Image extension must be jpg, jpeg, webp, or png.';
    } elseif ($img_size > 5) {$errors[] = 'Image size should be less than 5MB.';
    }

    if (empty($errors)) {
        // التأكد من وجود عمود badge لتفادي الأخطاء
        $badgeColumn = mysqli_query($connection, "SHOW COLUMNS FROM posts LIKE 'badge'");
        if ($badgeColumn && mysqli_num_rows($badgeColumn) === 0) {
            mysqli_query($connection, "ALTER TABLE posts ADD COLUMN badge VARCHAR(100) NOT NULL DEFAULT 'General' AFTER title");
        }

        $query = 'INSERT INTO posts (`badge`, `title`, `body`, `image`, `user_id`, `created_at`) VALUES (?, ?, ?, ?, 1, NOW())';
        $stmt  = mysqli_prepare($connection,$query);
        mysqli_stmt_bind_param($stmt, 'ssss', $badge,$title, $body,$img_new_name);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // معالجة نقل الصور بحذر لمراعاة Vercel Serverless environment
            $uploadDir = __DIR__ . '/../assets/image/postImage/';
            if (!file_exists($uploadDir)) {
                @mkdir($uploadDir, 0777, true);
            }
            
            $destination = $uploadDir .$img_new_name;
            @move_uploaded_file($img_tmp_name,$destination);

            $_SESSION['success'] = 'The post was inserted successfully! ✔';
            header('Location: /index.php');
            exit;
        }

        $_SESSION['errors'] = ['Insert failed: ' . mysqli_error($connection)];
        header('Location: /addPost.php');
        exit;
    }

    $_SESSION['errors'] =$errors;
    header('Location: /addPost.php');
    exit;
}
