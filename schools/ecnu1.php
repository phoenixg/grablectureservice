<?php
// 讲座报告
set_time_limit(0);

header("Content-type: text/html; charset=gbk");

include '../libs/phpquery/phpQuery-onefile.php';
define('BASE_URL', 'http://webplus.ecnu.edu.cn/');

$html = file_get_contents( 'http://webplus.ecnu.edu.cn/s/168/t/227/p/10/c/3893/list.jspy');

phpQuery::newDocumentHTML( $html , 'gbk' );

$table = pq('#nonedisp td > a');

$result = array();
foreach ($table as $index => $value) {
    $v = pq($value);

    $lecUrl = BASE_URL . $v->attr('href');
    $result[$index] = array(
        'lecUrl' => $lecUrl,
    );

    // parse the single lecture page
    phpQuery::newDocumentHTML( file_get_contents($lecUrl) , 'gbk' );

    $result[$index]['lecTitle'] = pq('#lecTitle')->html();
    $result[$index]['lecTime'] = pq('#lecBeginTime')->html();
    $result[$index]['lecSpeaker'] = pq('#lecSpeaker')->html();
    $result[$index]['lecAddress'] = pq('#lecAddress')->html();
    $result[$index]['lecContent'] = mb_convert_encoding(pq('#lecContent')->text(), 'GBK', 'UTF-8');
}

print_r($result);