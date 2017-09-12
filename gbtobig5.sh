#!/bin/sh
r=0
function myhelp() {
echo Usage: gbtobig5 [-r] FILE
echo rename the gbcode filename to big5code filename
echo
echo   -r, --recursive     rename the contents of directories recursively
echo   -h, --help          show this help page
echo
echo
echo   auther:   kenshinn, taiwan
echo   webpage:  http://www.wretch.cc/blog/kenshinn
echo   E-mail:   kenshinnn@gmail.com
echo   Msn:      kenshinnkimo@msn.com
echo
exit
}
function ren() {
i=$1
j=`echo $i|iconv -c -f utf8 -t gb2312 | iconv -c -f gb2312 -t big5 | iconv -c -f big5 -t utf8`
if [ $i = $j ] ; then return ; fi
echo `pwd`\/$i rename to `pwd`\/$j
mv $i $j
}
function dr() {
for i in $@ ; do
if [ -d $i ] && [ $r = 1 ] ; then cd $i ; dr * ; cd .. ;  fi
if [ -e $i ] ; then ren $i ; fi
done
}

IFS=""
for c in $@ ; do
if [ $c = -h ] || [ $c = --help ]  ; then myhelp ; fi
if [ $c = -r ] || [ $c = --recursive ] ; then r=1 ; continue ; fi
done
dr $@
