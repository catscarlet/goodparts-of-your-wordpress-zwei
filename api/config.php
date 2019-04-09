<?php

$allowed_referers = ['articles.catscarlet.com', '192.168.1.101'];
$mysqli = new mysqli('127.0.0.1', 'YOUR_WP_DATABASE_ACCOUNT', 'YOUR_WP_DATABASE_ACCOUNT', 'YOUR_WP_DATABASE');
$mysqli->set_charset('utf8mb4');

if ($mysqli->connect_errno) {
    echo 'Failed to connect to MySQL: ('.$mysqli->connect_errno.') '.$mysqli->connect_error;
}
