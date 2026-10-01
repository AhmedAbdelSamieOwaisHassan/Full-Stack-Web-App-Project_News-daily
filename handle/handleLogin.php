<?php

require_once __DIR__.'/../inc/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        $query = 'SELECT * FROM users WHERE email = ?';
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $verify = password_verify($password, $user['password']);

            if ($verify) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['success'] = 'Welcome '.$user['name'];
                header('location:../index.php');
                exit;
            }
        }

        // رسالة موحدة سواء الإيميل مش موجود أو الباسورد غلط
        $_SESSION['error'] = 'Invalid email or password ❌';
        header('location:../login.php');
        exit;
    }

    $_SESSION['error'] = 'Email and password are required ❌';
    header('location:../login.php');
    exit;
}
