#smbmount   //120.116.24.2/webworker ~/mount-path/w3  -o username=webworker,iocharset=utf8 

#gvfs-mount smb://webworker@120.116.24.2/webworker
sudo mount  //120.116.24.2/webworker ~/mount-path/w3  -o file_mode=0777,dir_mode=0777,uid=1000,username=webworker,iocharset=utf8,sec=lanman