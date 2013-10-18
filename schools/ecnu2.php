<?php
// 图书馆 闵行 & 中北
set_time_limit(0);
header("Content-type: text/html; charset=utf8");


include '../libs/phpquery/phpQuery-onefile.php';
// 闵行： http://202.120.82.25/il/list_mh201302.html
$html = file_get_contents( 'http://202.120.82.25/il/list_mh201302.html');
// 中北： http://202.120.82.25/il/list_zb201302.html
$html = file_get_contents( 'http://202.120.82.25/il/list_zb201302.html');

phpQuery::newDocumentHTML( $html , 'utf8' );

$table = pq('.feat_prod_box_2 tr');

$result = array();
foreach ($table as $index => $value) {
    if($index == 0) continue;

    $v = pq($value);

    if(trim($v->find('td:eq('.(1).')')->text()) == '')
        continue;
    $result[$index]['lecTitle'] = trim(preg_replace('/\s+/', '', str_replace(PHP_EOL, '', $v->find('td:eq('.(1).')')->text())));
    $result[$index]['lecContent'] = trim(preg_replace('/\s+/', '', str_replace(PHP_EOL, '', $v->find('td:eq('.(1 + 1).')')->text())));
    $result[$index]['lecTime'] = preg_replace('/\s+/', ' ', str_replace(PHP_EOL, '', trim($v->find('td:eq('.(1 + 2).')')->text())));
    $result[$index]['lecSpeaker'] = trim(preg_replace('/\s+/', '', str_replace(PHP_EOL, '', $v->find('td:eq('.(1 + 3).')')->text())));
    $result[$index]['lecAddress'] = trim(preg_replace('/\s+/', '', str_replace(PHP_EOL, '', $v->find('td:eq('.(1 + 4).')')->text())));
}

print_r($result);