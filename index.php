<?php
header("Content-type: text/html; charset=gbk");

include './libs/phpquery/phpQuery-onefile.php';

$html = file_get_contents( 'http://webplus.ecnu.edu.cn/s/168/t/227/p/10/c/3893/list.jspy');

phpQuery::newDocumentHTML( $html , 'gbk');

$z = pq('td > a');

foreach ($z as $key => $value) {

    $x = pq($value);

    echo '<p>'.$x->html().'</p>';

    echo '<p>'.$x->attr('href').'</p>';

}