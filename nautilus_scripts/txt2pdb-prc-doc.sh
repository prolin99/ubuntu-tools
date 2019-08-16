#!/bin/bash
#檔案名 txt2pdbdoc.sh (包含以下目錄)
#    * 需安裝套件 ： nautilus-script-manager
#    * 把檔案放在： $HOME/.gnome2/nautilus-scripts ， 
#    * 在檔案瀏覽器中，選擇檔案按滑鼠右鍵會出現 -- 指令稿-->txt2pdbdoc 
#
function trans() {
	for fn in $*
	do
        	#取得最後檔名部份
        	base_name=${fn##*/}
        	#取得路徑
        	n_path=${fn%/*}
 
		old=$base_name
 

 
		if [ ${base_name##*.} == "pdb" ] || [ ${base_name##*.} == "PDB" ]; then
			txt2pdbdoc -d    "$n_path/$old"    "$n_path/${base_name%.*}.txt"
			#echo  $n_path/$old   "$n_path/${base_name%.*}.txt"   >>  ~/mv.log
      	        fi
		if [ ${base_name##*.} == "prc"   ]; then
			~/tools/makedoc7  -d    "$n_path/$old"    "$n_path/${base_name%.*}.txt"
			echo  $n_path/$old   "$n_path/${base_name%.*}.txt"   >>  ~/mv.log
      	        fi      	        
        done	

}	

function dr() {
#一定要加入  local ，否則會成全域變數
local ni 
for i in $* ; do
        ni=$i
 	#判斷為目錄再進入
	if [ -d $i ]   ; then
	   
 	   fn_list=`ls -d $i/*`
	   dr  $fn_list  
 
  	fi
  	
	if [ -e $ni ] ; then 
	   trans $ni 
 	fi
done

}

IFS=$'\n'
for FILENAME in $NAUTILUS_SCRIPT_SELECTED_FILE_PATHS
do
       dr  $FILENAME  
done 

