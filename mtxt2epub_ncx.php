#!/usr/bin/php -q
<?php
//<meta charset=utf-8">


$html_beg='<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE ncx PUBLIC "-//NISO//DTD ncx 2005-1//EN"
   "http://www.daisy.org/z3986/2005/ncx-2005-1.dtd">

<ncx xmlns="http://www.daisy.org/z3986/2005/ncx/" version="2005-1">
    <head>
        <meta name="dtb:uid" content="3be84e1d-9a60-4ba3-a47d-27db99d345ba"/>
        <meta name="dtb:depth" content="1"/>
        <meta name="dtb:totalPageCount" content="0"/>
        <meta name="dtb:maxPageNumber" content="0"/>
    </head>
    <docTitle>
        <text>匯整</text>
    </docTitle>
    <navMap>
    ' ;


$html_end="
    </navMap>
</ncx>  " ;


//取得檔案參數   txt 、 path
$txt_file = $argv[1] ;
$txt_path = $argv[2] . "/OEBPS/toc.ncx" ;
$fsc=$argv[3] ;

$lines = file_get_contents( $argv[2]  . "/tmp_toc.ncx" );
	$file = $txt_path   ;

	$f=file_put_contents($file, $html_beg . $lines . $html_end );





?>
