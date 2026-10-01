<?php

require_once __DIR__.'/../inc/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $errors = [];

    if (empty($name)) {
        $errors[] = 'The name should exist ❌';
    }
    if (empty($phone)) {
        $errors[] = 'The phone should exist ❌';
    }
    if (empty($email)) {
        $errors[] = 'The email should exist ❌';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'The email format is invalid ❌';
    }
    if (empty($password)) {
        $errors[] = 'The password should exist ❌';
    } elseif (strlen($password) < 6) {
        $errors[] = 'Password must be at least 6 characters ❌';
    }

    // فحص تكرار الإيميل، بس لو باقي الفحوصات نظيفة
    if (empty($errors)) {
        $checkQuery = 'SELECT id FROM users WHERE email = ?';
        $checkStmt = mysqli_prepare($connection, $checkQuery);
        mysqli_stmt_bind_param($checkStmt, 's', $email);
        mysqli_stmt_execute($checkStmt);
        $checkResult = mysqli_stmt_get_result($checkStmt);

        if (mysqli_num_rows($checkResult) > 0) {
            $errors[] = 'This email is already registered ❌';
        }
    }

    if (empty($errors)) {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = 'INSERT INTO users (name, phone, email, password) VALUES (?, ?, ?, ?)';
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, 'ssss', $name, $phone, $email, $hashPassword);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            $_SESSION['success'] = 'The user has been created successfully ✔';
            header('location: ../login.php');
            exit;
        } else {
            $errors[] = 'Registration failed: '.mysqli_error($connection);
        }
    }

    $_SESSION['errors'] = $errors;
    header('location: ../register.php');
    exit;
}
