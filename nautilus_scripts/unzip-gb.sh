#!/bin/bash
#created by Thomas - tlinux.tsai at gmail dot com
file="$1"
zip_path=`echo $file | sed 's/.zip//gi'`
LANG=zh_CN 7z e $file -o$zip_path
convmv --notest  -f gb2312 -t utf8 $zip_path/*