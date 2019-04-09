<?php

header('Content-Type: text/json');

include_once 'config.php';

$permalink_switch = false;

$link_perfix = 'https://blog.catscarlet.com/';
$permalink_pattern = '#(\d\d\d\d)-(\d\d)-(\d\d)#';
$link_postfix = '.html';

$query = "SELECT ID, post_date, post_title FROM `wp_posts` WHERE post_status = 'publish' and post_title <> ''";
$result = $mysqli->query($query);
$list = array();

while ($row = $result->fetch_assoc()) {
    if ($permalink_switch) {
        preg_match($permalink_pattern, $row['post_date'], $matches);
        $permalink = $matches[1].$matches[2].$matches[3].$row['ID'];
        $row['permalink'] = $link_perfix.$permalink.$link_postfix;
    } else {
        $row['permalink'] = null;
    }

    $list[] = $row;
}

$result->free();
rsort($list);

//$rst = json_encode($list, JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES /*+ JSON_PRETTY_PRINT*/);
//echo $rst;

echo '['."\n";
foreach ($list as $i => $item) {
    echo '{';
    echo '"ID": '.$item['ID'].',"post_date": "'.$item['post_date'].'","post_title": "'.$item['post_title'].'","permalink": "'.$item['permalink'].'"';
    echo '}';
    if ($i != count($list) - 1) {
        echo ',';
    }
    echo "\n";
}
echo ']';
