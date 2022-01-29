<?php

mysqli_report(MYSQLI_REPORT_STRICT);

$allowed_referers = ['localhost', '127.0.0.1'];

try {
    $mysqli = new mysqli('127.0.0.1', 'YOUR_WP_DATABASE_ACCOUNT', 'YOUR_WP_DATABASE_ACCOUNT_PASSWORD', 'YOUR_WP_DATABASE', 'YOUR_WP_DATABASE_PORT');
    $mysqli->set_charset('utf8mb4');
} catch (Exception $e) {
    http_response_code(500);
    //echo 'Service unavailable';
    echo $e->getMessage();
    exit;
}
