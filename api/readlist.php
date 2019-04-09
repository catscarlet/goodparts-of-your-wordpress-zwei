<?php

header('Content-Type: text/json');
//header('Access-Control-Allow-Origin:*');
//header('Access-Control-Allow-Methods:GET,OPTIONS');
//header('Access-Control-Allow-Headers:x-requested-with,content-type');

include_once 'config.php';

if (isset($allowed_referers)) {
    if (!array_key_exists('HTTP_REFERER', $_SERVER) || !in_array(parse_url($_SERVER['HTTP_REFERER'])['host'], $allowed_referers)) {
        reject();
    }
}

$list = file_get_contents('./list.json');

echo $list;

function reject()
{
    http_response_code(403);
    $result = [];
    $result['result'] = 403;
    $result['content'] = '\''.parse_url($_SERVER['HTTP_REFERER'])['host'].'\' is not a loading the List JavaScript API has not been added to the list of allowed referrers. Please check the referrer settings of your API.';
    $rst = json_encode($result, JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);

    echo $rst;
    exit();
}
