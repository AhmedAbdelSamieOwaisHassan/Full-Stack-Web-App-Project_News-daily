<?php
$requestUri = $_SERVER['REQUEST_URI'];
$parsedUrl  = parse_url($requestUri, PHP_URL_PATH);

// استخراج اسم الملف
$file = ltrim($parsedUrl, '/');

if ($file === '' || $file === 'index.php') {
    $file = 'index.php';
}

$filePath = __DIR__ . '/../' . $file;

// التحقق من وجود الملف
if (file_exists($filePath) && is_file($filePath)) {
    require $filePath;
    exit;
} else {
    http_response_code(404);
    echo "<h1>404 - Page Not Found</h1>";
    exit;
}
