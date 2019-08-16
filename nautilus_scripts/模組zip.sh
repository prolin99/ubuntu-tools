#!/bin/bash
#檔案名 epub檔簡轉繁 (包含以下目錄)
#    * 需安裝套件 ： nautilus-script-manager
#    * 把檔案放在： $HOME/.gnome2/nautilus-scripts ，檔名例如為：簡轉繁，並加入執行權限。
#    * 在檔案瀏覽器中，選擇檔案按滑鼠右鍵會出現 -- 指令稿-->epub簡轉繁 
#

IFS=$'\n'
#echo   begin  > ~/bom.log
for FILENAME in $NAUTILUS_SCRIPT_SELECTED_FILE_PATHS
do       
         #取得最後檔名部份
        base_name=${FILENAME##*/}
        #取得路徑
        n_path=${FILENAME%/*}
        

        new=$base_name-`date +%Y%m%d`
       cd $n_path
        
       zip -r $new $base_name/* 
	   #echo  zip -r $base_name {$base_name}/*  >> ~/bom.log     
done 
# gedit ~/bom.log               