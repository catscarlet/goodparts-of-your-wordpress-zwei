<?php

$log['REQUEST_TIME'] = date('c', $_SERVER['REQUEST_TIME']);
$log['REQUEST_URI'] = $_SERVER['REQUEST_URI'];
$log['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];
if (array_key_exists('HTTP_REFERER', $_SERVER)) {
    $log['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];
}
$log['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];

$rst = json_encode($log, JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES);

$path = './api.log';

//file_put_contents($path, $rst."\n", FILE_APPEND);
