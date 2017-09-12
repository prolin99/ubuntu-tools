#smbmount   //120.116.24.1/office1 ~/mount-path/office1  -o username=office1,iocharset=utf8 

#gvfs-mount smb://office1@120.116.24.1/office1   ,sec=lanman
#echo syps
sudo mount   //120.116.24.1/office1 ~/mount-path/office1  -o file_mode=0777,dir_mode=0777,uid=1000,username=office1,iocharset=utf8