<?php

// 讲座信息 http://news.tongji.edu.cn/classid-21.html

set_time_limit(0);

header("Content-type: text/html; charset=gbk");

include '../libs/phpquery/phpQuery-onefile.php';
define('BASE_URL', 'http://news.tongji.edu.cn/');

$html = file_get_contents( 'http://news.tongji.edu.cn/classid-21.html');

phpQuery::newDocumentHTML( $html , 'gbk' );

$table = pq('#content .news_list a');

$result = array();
foreach ($table as $index => $value) {
    $v = pq($value);

    $lecUrl = BASE_URL . $v->attr('href');
    $result[$index] = array(
        'lecUrl' => $lecUrl,
    );

    // parse the single lecture page
    phpQuery::newDocumentHTML( file_get_contents($lecUrl) , 'gbk' );

    $result[$index]['lecTitle'] = pq('.news_title')->html();
    // todo
    /*
    $result[$index]['lecTime'] = pq('#lecBeginTime')->html();
    $result[$index]['lecSpeaker'] = pq('#lecSpeaker')->html();
    $result[$index]['lecAddress'] = pq('#lecAddress')->html();
    $result[$index]['lecContent'] = mb_convert_encoding(pq('#lecContent')->text(), 'GBK', 'UTF-8');
    */
    print_r($result);die;
}

