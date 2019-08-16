#!/bin/bash
#檔案名 簡轉繁
#    * 需安裝套件 ： nautilus-script-manager
#    * 把檔案放在： $HOME/.gnome2/nautilus-scripts ，檔名例如為：簡轉繁，並加入執行權限。
#    * 在檔案瀏覽器中，選擇檔案按滑鼠右鍵會出現 -- 指令稿-->簡轉繁 
IFS=$'\n'
for FILENAME in $NAUTILUS_SCRIPT_SELECTED_FILE_PATHS
do
        #取得最後檔名部份
        base_name=${FILENAME##*/}
        #取得路徑
        n_path=${FILENAME%/*}

	old=$base_name
        old2=`echo $old |~/tools/chinese-conv.php`
      #  echo   $old   $old2    >  ~/rm.log
 	#new=`date +%Y%m`$old 
 	#取得建制日期，只取第一段年-月-日
 	new=$(stat -c  %y $old | awk '{print $1}')-$old2 
   	mv $n_path/$old   $n_path/$new
 

done 