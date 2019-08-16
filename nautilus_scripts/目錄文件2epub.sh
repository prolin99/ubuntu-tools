#!/bin/bash
#檔案名 epub檔簡轉繁 (包含以下目錄)
#    * 需安裝套件 ： nautilus-script-manager
#    * 把檔案放在： $HOME/.gnome2/nautilus-scripts ，檔名例如為：簡轉繁，並加入執行權限。
#    * 在檔案瀏覽器中，選擇檔案按滑鼠右鍵會出現 -- 指令稿-->epub簡轉繁 
#
function txt2epub() {
	#echo  dddd $fn   >> ~/mv.log
 	if [ -e $i ]   ; then
         	#取得最後檔名部份
        	base_name=${fn##*/}
        	#取得路徑
        	#epub_path=${fn%/*}
        	author=${epub_path##*/}
 
		fn_old=$base_name       
		
		#繁體檔名
		#fn_new=`echo $fn_old |iconv -c -f utf8 -t gb2312 | iconv -c -f gb2312 -t big5 | iconv -c -f big5 -t utf8`
		if  [ $fc -eq 0 ] ; then
			fn_new="${base_name%.*}.epub"
		        #echo  $fn_new  >> ~/mv.txt
			#解開 epub ，到工作目錄 tmp_epub
               	 	unzip  ~/tools/epub-src.epub  -d  $epub_path/tmp_epub
                	chmod 755   $epub_path/tmp_epub  -R		
		fi
		
		let fc=fc+1


                #轉繁體動作
                #dr  $epub_path/tmp_epub
                #把文字檔轉為 /OEBPS/Text/ch01.html  (最多10個文字檔)
                php ~/tools/mtxt2epub.php  $fn  $epub_path/tmp_epub  $fc
                #echo   ~/tools/mtxt2epub.php  $fn   $epub_path/tmp_epub  $fc   >> ~/mv.txt
                #echo   $fn  $epub_path/tmp_epub   > ~/t.txt	
 	fi
}	
 
	
function dr() {
	#一定要加入  local ，否則會成全域變數
	local ni 
	for i in $* ; do
 		ni=$i
 		
		#判斷為目錄再進入
		if [ -d $i ]   ; then
		        fc=0
		        fn_new='aaaa'
 			epub_path=$i 
		        #echo   beg  $i  >  ~/mv.log
 
		        filelist=`ls -d $i/*`
		        
		        for fn  in $filelist
		        do 
 				txt2epub $fn
 				#echo txt2epub   $fn >>  ~/mv.log
 			done
 			
 			
                #重新打包繁體 epub 檔，會放在 tw 次目錄中
  		#產生章節檔  content.opf 
  		#echo   $epub_path/tmp_epub  $fn_new >>  ~/mv.log
                php ~/tools/mtxt2epub_opf.php  $fn  $epub_path/tmp_epub  $fc   $fn_new 
 
                cd  $epub_path/tmp_epub
             
                php ~/tools/mtxt2epub_ncx.php  $fn  $epub_path/tmp_epub  $fc

                rm -f ./tmp_toc.ncx
                
 
                zip -Xr9D ../../$fn_new   mimetype *
                
                
                #清除工作目錄
                rm -fR  $epub_path/tmp_epub
                
                
             	fi

	done

}

 IFS=$'\n'
for FILENAME in $NAUTILUS_SCRIPT_SELECTED_FILE_PATHS
do
       dr  $FILENAME  
done                
                