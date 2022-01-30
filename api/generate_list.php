<?php

include_once 'config.php';

$permalink_switch = false;  //Set to `true` only if you know how to generate your posts' permalink, or else leave this to `false`.

$link_perfix = 'YOUR_WP_LINK_PERFIX';
$permalink_pattern = 'YOUR_WP_LINK_PERMALINK_PATTERN';
$link_postfix = 'YOUR_WP_LINK_POSTFIX';

/*
// This is a example about how to generate my own blog's posts' permalink. (Part 1)

$link_perfix = 'https://blog.catscarlet.com/';
$permalink_pattern = '#(\d\d\d\d)-(\d\d)-(\d\d)#';
$link_postfix = '.html';
*/

$query = "SELECT ID, post_date, post_title FROM `wp_posts` WHERE post_status = 'publish' and post_title <> ''";
$result = $mysqli->query($query);
$list = array();

while ($row = $result->fetch_assoc()) {
    if ($permalink_switch) {
        // This is a example about how to generate my own blog's posts' permalink. (Part 2)
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

header('Content-Type: text/json');

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
