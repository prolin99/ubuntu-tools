#!/usr/bin/php -q
<?php

$inputstr='' ;

//讀入資料
$lines = file('php://stdin');
 foreach ($lines as $k => $v) {
     $inputstr .= $v ;
 }

$str_utf8= iconv('gbk','utf8', $inputstr) ;


echo $str_utf8;

?>
