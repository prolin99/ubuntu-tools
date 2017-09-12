#smbmount   //120.116.24.1/upload   ~/mount-path/tmp  -o username=nobody,iocharset=utf8 

#gvfs-mount smb://120.116.24.1/upload

sudo mount //120.116.24.1/f4作業   ~/mount-path/f4  -o file_mode=0777,dir_mode=0777,uid=1000,username=nobody,iocharset=utf8,sec=lanman 
