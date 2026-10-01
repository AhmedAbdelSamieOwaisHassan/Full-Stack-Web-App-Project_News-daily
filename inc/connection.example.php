<?php

session_start();

$hostName = getenv('DB_HOST') ?: 'localhost';
$DBuser = getenv('DB_USER') ?: ($hostName === 'localhost' ? 'root' : '');
$password = getenv('DB_PASSWORD') ?: '';
$dbName = getenv('DB_NAME') ?: ($hostName === 'localhost' ? 'site_news_project' : '');
$port = (int) (getenv('DB_PORT') ?: ($hostName === 'localhost' ? 3306 : 4000));

$isRemote = !in_array(strtolower($hostName), ['localhost', '127.0.0.1'], true);

if ($isRemote && ($DBuser === '' || $password === '' || $dbName === '')) {
    error_log('Remote database settings are incomplete.');
    http_response_code(500);
    exit('Database environment variables are incomplete.');
}

$connection = mysqli_init();

if (!$connection) {
    error_log('Database initialization failed.');
    http_response_code(500);
    exit('Database connection failed.');
}

if ($isRemote) {
    // تفعيل اتصال SSL مرن متوافق مع Vercel و TiDB
    mysqli_ssl_set($connection, null, null, null, null, null);
    mysqli_options($connection, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);
}

$flags = $isRemote ? MYSQLI_CLIENT_SSL : 0;
$connected = @mysqli_real_connect($connection, $hostName, $DBuser, $password, $dbName, $port, null, $flags);

if (!$connected) {
    error_log('Database connection failed: '.mysqli_connect_error());
    http_response_code(500);
    exit('Database connection failed. Check server logs and settings.');
}

mysqli_set_charset($connection, 'utf8mb4');