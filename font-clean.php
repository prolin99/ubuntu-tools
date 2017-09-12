#!/usr/bin/php -q
<?

//去除 font 字型設定

$string = '@font-face {
font-family:"cnepub";
src:url(res:///opt/sony/ebook/FONT/tt0011m_.ttf), url(res:///tt0011m_.ttf);
}
font-family:"cnepub", serif;
'
;
$patterns = array();
$patterns[0] = '/@font-face?{*src:url*/';
$patterns[1] = '/font-family/';

$replacements = array();
$replacements[0] = 'aaaaaaaaaaaaaaaa';
$replacements[1] = 'bbbbbbbbb';

echo preg_replace($patterns, $replacements, $string);
preg_match("/@font-face*.}/",  $string,$matches, PREG_OFFSET_CAPTURE);
print_r($matches);

?>
