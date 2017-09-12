#!/usr/bin/php -q
<?php
//<meta charset=utf-8">


$html_beg='<?xml version="1.0" encoding="utf-8" standalone="no"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" xmlns:xml="http://www.w3.org/XML/1998/namespace">
<head>
  <!-- InstanceBeginEditable name="doctitle" -->


  <link href="../Styles/Style.css" rel="stylesheet" type="text/css" /><!-- InstanceBeginEditable name="head" -->
  <!-- InstanceEndEditable -->
</head>

<body>
  <div>
    <div>
      <!-- InstanceBeginEditable name="Content" -->
      ' ;

$html_end='          </div><!--End content-->
  </div><!--End ADE-->
  <!-- InstanceEnd -->
</body>
</html>' ;

/**
 * 判斷檔案是不是 utf8?>
return 0=不是 utf8,1=是utf8
*/
function checkUTF8($str) {
  // $str=file_get_contents($suc_file);

      if  ( ord($str[0])== 0xFF  and ord($str[1])== 0xFe )
          return  "UTF-16LE" ;
      if  ( ord($str[0])== 0xFE  and ord($str[1])== 0xFF)
          return  "UTF-16BE" ;

      if  ( ord($str[0])== 0xFE  and ord($str[1])== 0xBB   and ord($str[2])== 0xBF )
          return  "UTF-8" ;

      for($i = 0; $i < strlen($str); $i++){
          $value = ord($str[$i]);
          if($value > 127) {
              if($value >= 192 && $value <= 247) return "UTF-8";
              else return (0);//.die('Not a UTF-8 compatible string');
          }
      }
      return (0);
}



//讀入資料
//$lines = file_get_contents('php://stdin');

//取得檔案參數   txt 、 path
$txt_file = $argv[1] ;
$txt_path = $argv[2] . "/OEBPS/Text/" ;
$beg_fn=$argv[3] ;

//讀入資料
$lines = file_get_contents( $txt_file );


$code= checkUTF8( $lines) ;
//  echo '===========' . $code ;

if  ($code===0 )
    $code ="BIG5" ;
//  echo '===========' . $code ;

if    ($code<>  "UTF-8" )
     $lines =  iconv($code, "UTF-8", $lines) ;

     $lines = preg_replace("/　/","",$lines) ;
     $lines2 =   preg_split('/\n/' ,$lines) ;

     $col =0 ;
     $chap=101 +  $beg_fn -1 ;

     $first=0 ;
     $inputstr='' ;
 foreach ($lines2 as $k => $v) {
	$v = trim(preg_replace("/　/","",$v)) ;

	if ($v) {
		//取得第一行寫入暫存檔做index
		if  ($first==0 ) {
		    	$handle = fopen( $argv[2] .  "/tmp_toc.ncx", "a+");
		    	echo $argv[2] . "/tmp_toc.ncx" ;
		    	$title =" <navPoint id=\"navPoint-" . $beg_fn ."\" playOrder=\"$beg_fn\">
     <navLabel>
       <text>$beg_fn - $v</text>
     </navLabel>
    <content src=\"Text/ch" .$chap . ".html\"/>
</navPoint>\n" ;
		    	fwrite($handle, $title );
		    	$inputstr.="<h1>" . htmlspecialchars(trim($v))."</h1>	\n" ;
 			$first= 1 ;
		}

		$inputstr.="<p>" . htmlspecialchars(trim($v))."</p>	\n" ;
		$col ++ ;
		if  ($col  % 4000 ==0 ) {
			$file = $txt_path  ."ch" . $chap  .".html" ;
			$f=file_put_contents($file, $html_beg . $inputstr . $html_end );
			$chap ++ ;
			$inputstr = "" ;
		}
	}



// $inputstr.= $v ;
 }

 if  ($inputstr) {
	$file = $txt_path  ."ch" . $chap  .".html" ;
	$f=file_put_contents($file, $html_beg . $inputstr . $html_end );
}


//echo  $html_beg . $inputstr . $html_end;



?>
