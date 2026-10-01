<?php

// session_start();
// $hostName = 'localhost';
// $DBuser = 'root';
// $password = '';
// $dbName = 'site_news_project';
// $connection = mysqli_connect($hostName, $DBuser, $password, $dbName);

session_start();

$hostName = 'localhost';
$DBuser = 'root';
$password = '';
$dbName = 'site_news_project';

$connection = mysqli_connect($hostName, $DBuser, $password, $dbName);

if (!$connection) {
    $_SESSION['errors'] = ['Database connection failed: '.mysqli_connect_error()];
    header('Location: ../addPost.php');
    exit;
}