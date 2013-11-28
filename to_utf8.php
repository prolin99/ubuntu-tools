#!/usr/bin/php5 -q
<?php

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
$lines = file_get_contents('php://stdin');
$code= checkUTF8( $lines) ;
//  echo '===========' . $code ;

//if  ($code===0 )
    $code ="cp936" ;
//  echo '===========' . $code ;

 echo    $lines  ;
 
if    ($code<>  "UTF-8" )
     $lines =  iconv($code, "UTF-8", $lines) ;   
 
 
 
 echo    $lines  ;
?>