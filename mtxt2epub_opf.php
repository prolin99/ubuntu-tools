#!/usr/bin/php -q
<?php
//<meta charset=utf-8">

//取得檔案參數   txt 、 path
$txt_file = $argv[1] ;
$txt_path = $argv[2] . "/OEBPS/content.opf" ;
$fsc=$argv[3] ;
$title =$argv[4] ;

$html_beg='<?xml version="1.0" encoding="UTF-8"?>
<package xmlns="http://www.idpf.org/2007/opf" unique-identifier="BookID" version="2.0">
    <metadata xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:opf="http://www.idpf.org/2007/opf">
        <dc:title>'.$title.' </dc:title>
        <dc:creator opf:role="aut">1</dc:creator>
        <dc:language>zh</dc:language>
        <dc:identifier id="BookID" opf:scheme="UUID">urn:uuid:8c7b74e5-d8c5-40e1-bf6f-55cbc5db9c1f</dc:identifier>
        <meta name="Sigil version" content="0.3.4"/>
    </metadata>
    <manifest>
	<item id="ncx" href="toc.ncx" media-type="application/x-dtbncx+xml"/>
        <item id="Style.css" href="Styles/Style.css" media-type="text/css"/>
    ' ;

$html_mid='
    </manifest>
    <spine toc="ncx">
 ' ;

$html_end="
    </spine>
</package>   " ;




for ( $i=0 ; $i <=$fsc  ; $i++) {
	$fn="ch" . (100+ $i) .  ".html"  ;

	$t1 .= " <item id=\"$fn\" href=\"Text/$fn\" media-type=\"application/xhtml+xml\"/>\n";
 	$t2 .="<itemref idref=\"$fn\"/>\n" ;
}


	$file = $txt_path   ;

	$f=file_put_contents($file, $html_beg . $t1 . $html_mid . $t2 . $html_end );





?>
