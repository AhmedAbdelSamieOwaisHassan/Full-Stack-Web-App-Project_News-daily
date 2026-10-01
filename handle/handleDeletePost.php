<?php

require_once __DIR__.'/../inc/connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM posts WHERE id = $id";
    $result = mysqli_query($connection, $query);
    if ($result) {
        $_SESSION['success'] = 'Post deleted successfully.✔';
        header('location:../index.php');
        exit;
    } else {
        $_SESSION['error'] = 'Failed to delete post.❌';
        header('location:../index.php');
        exit;
    }
}
