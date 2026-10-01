<?php

session_start();

$hostName = getenv('DB_HOST') ?: 'localhost';
$DBuser = getenv('DB_USER') ?: ($hostName === 'localhost' ? 'root' : '');
$password = getenv('DB_PASSWORD') ?: '';
$dbName = getenv('DB_NAME') ?: ($hostName === 'localhost' ? 'site_news_project' : '');
$port = (int) (getenv('DB_PORT') ?: ($hostName === 'localhost' ? 3306 : 4000));
$caPath = getenv('DB_CA_PATH') ?: null;
$caCertificate = getenv('DB_CA_CERT');
$temporaryCaPath = null;

$isRemote = !in_array(strtolower($hostName), ['localhost', '127.0.0.1'], true);

if ($isRemote && ($DBuser === '' || $password === '' || $dbName === '')) {
    error_log('Remote database settings are incomplete.');
    http_response_code(500);
    exit('Database environment variables are incomplete.');
}

if ($isRemote) {
    if (!$caPath && ($caCertificate === false || $caCertificate === '')) {
        error_log('DB_CA_CERT or DB_CA_PATH is required for a remote database connection.');
        http_response_code(500);
        exit('Database TLS certificate is not configured.');
    }

    if ($caCertificate !== false && $caCertificate !== '') {
        $temporaryCaPath = tempnam(sys_get_temp_dir(), 'db-ca-');
        if ($temporaryCaPath === false || file_put_contents($temporaryCaPath, $caCertificate) === false) {
            error_log('Database CA certificate could not be prepared.');
            http_response_code(500);
            exit('Database TLS certificate could not be loaded.');
        }
        $caPath = $temporaryCaPath;
    }
}

$connection = mysqli_init();

if (!$connection) {
    error_log('Database initialization failed.');
    http_response_code(500);
    exit('Database connection failed.');
}

if ($isRemote) {
    mysqli_options($connection, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);
    mysqli_ssl_set($connection, null, null, $caPath, null, null);
}

$flags = $isRemote ? MYSQLI_CLIENT_SSL : 0;
$connected = mysqli_real_connect($connection, $hostName, $DBuser, $password, $dbName, $port, null, $flags);

if ($temporaryCaPath !== null) {
    unlink($temporaryCaPath);
}

if (!$connected) {
    error_log('Database connection failed: '.mysqli_connect_error());
    http_response_code(500);
    exit('Database connection failed. Check the server logs and database settings.');
}

mysqli_set_charset($connection, 'utf8mb4');