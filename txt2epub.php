#!/usr/bin/php -q
<?php

//<meta charset=utf-8">


$html_beg='<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW">
<head>
  <!-- InstanceBeginEditable name="doctitle" -->
  <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8"/>
  <meta name="EPB-UUID" content=""/>

  <link href="../Styles/Style.css" rel="stylesheet" type="text/css" />

</head>

<body>
  <div>
    <div>
      <!-- InstanceBeginEditable name="Content" -->
      ' ;



$html_end='          </div><!--End content-->
  </div><!--End ADE-->

</body>
</html>' ;

/**
 * 判斷檔案是不是 utf8?>
return 0=不是 utf8,1=是utf8
*/

function checkUTF8($str)
{
    // $str=file_get_contents($suc_file);

    if (ord($str[0])== 0xFF  and ord($str[1])== 0xFe) {
        return  "UTF-16LE" ;
    }
    if (ord($str[0])== 0xFE  and ord($str[1])== 0xFF) {
        return  "UTF-16BE" ;
    }

    if (ord($str[0])== 0xFE  and ord($str[1])== 0xBB   and ord($str[2])== 0xBF) {
        return  "UTF-8" ;
    }

    for ($i = 0; $i < strlen($str); $i++) {
        $value = ord($str[$i]);
        if ($value > 127) {
            if ($value >= 192 && $value <= 247) {
                return "UTF-8";
            } else {
                return ('XXX');
            }//.die('Not a UTF-8 compatible string');
        }
    }
    return ('XXX');
}



//讀入資料
//$lines = file_get_contents('php://stdin');

//取得檔案參數   txt 、 path
$txt_file = $argv[1] ;
$txt_path = $argv[2] . "/OEBPS/Text/" ;
$code_set =  $argv[3] ;
//讀入資料
$lines = file_get_contents($txt_file);
//$encode = mb_detect_encoding($lines, array('ASCII','GB2312′,'GBK’,'BIG5','UTF-8');


$lines_list =   preg_split('/\n/', $lines) ;

foreach ($lines_list as $k => $v) {
  if (trim($v)<>'') {
    echo '------'   .trim($v)  ;
    $code= checkUTF8($v) ;  //是否 UTF-8 UTF-16LE UTF-16BE

    if ($code <>  "UTF-8") {
      if ($code ==='XXX'){
        //再檢查是否 BIG-5  GBK
        $code = mb_detect_encoding( $v, array('ASCII' ,'BIG-5' ,'EUC-CN' , 'GBK'   ) );

        echo "***  $code *** " ;
      }
    }
  } else
    break ;
}

$lines=  mb_convert_encoding($lines, "UTF-8", $code ) ;
//echo $lines ;
echo "======  $code" ;


$lines = preg_replace("/　/", "", $lines) ;
$lines2 =   preg_split('/\n/', $lines) ;

$col =0 ;
$chap=101 ;
$chap_ord =1 ;

//加入首頁功能，放入章節檔
$toc_data = "
 <navPoint id='navPoint-" .$chap_ord ."' playOrder='$chap_ord'>
   <navLabel>
     <text>首頁</text>
   </navLabel>
   <content src='Text/ch101.html'/>
 </navPoint>" ;

$chap_ord++ ;

foreach ($lines2 as $k => $v) {
     $v = trim(preg_replace("/　/", "", $v)) ;

     if ($v) {
         //如果是章節 開頭字
         if (preg_match("/^第.+(章|節)/", $v)) {
             $inputstr_n ="<h1>" . htmlspecialchars($v)."</h1>	\n" ;
             $next_chapter = true ;
             //目錄 toc.ncx 檔案
             $top_title =htmlspecialchars($v) ;
             $chap_file = "ch" . ($chap +1)  .".html" ;
             $toc_data .= "
              <navPoint id='navPoint-" .$chap_ord ."' playOrder='$chap_ord'>
                <navLabel>
                  <text>$top_title</text>
                </navLabel>
                <content src='Text/$chap_file'/>
              </navPoint>" ;
             $chap_ord ++ ;
         } else {
             $inputstr.="<p>" . htmlspecialchars($v)."</p>	\n" ;
             $next_chapter = false  ;
         }

         $col ++ ;
         if ($next_chapter) {
             //要換檔
             $file = $txt_path  ."ch" . $chap  .".html" ;
             $f=file_put_contents($file, $html_beg . $inputstr . $html_end);
             $chap ++ ;
             $inputstr = $inputstr_n ;
             $col = 1 ;
         } elseif ($col  % 600 ==0) {
             $file = $txt_path  ."ch" . $chap  .".html" ;
             $f=file_put_contents($file, $html_beg . $inputstr . $html_end);
             $chap ++ ;
             $inputstr = "" ;
         }
     }



     // $inputstr.= $v ;
}

if ($inputstr) {
   $file = $txt_path  ."ch" . $chap  .".html" ;
   $f=file_put_contents($file, $html_beg . $inputstr . $html_end);
}

//寫入到 toc.ncx 檔案
if ($toc_data) {
    $toc_data=
      '<?xml version="1.0" encoding="UTF-8"?>
      <!DOCTYPE ncx PUBLIC "-//NISO//DTD ncx 2005-1//EN"
         "http://www.daisy.org/z3986/2005/ncx-2005-1.dtd">

      <ncx xmlns="http://www.daisy.org/z3986/2005/ncx/" version="2005-1">
        <head>
          <meta name="dtb:uid" content="urn:uuid:eba0e149-7241-43f3-a563-7b132597c3a5"/>
          <meta name="dtb:depth" content="1"/>
          <meta name="dtb:totalPageCount" content="0"/>
          <meta name="dtb:maxPageNumber" content="0"/>
        </head>
        <docTitle>'.

          "<text> 0000000000 </text>
        </docTitle>
          <navMap>
        $toc_data
      </navMap>
      </ncx>" ;
    $file =$argv[2]  . "/OEBPS/toc.ncx" ;
    $f=file_put_contents($file, $toc_data);
}

//echo  $html_beg . $inputstr . $html_end;



?>
