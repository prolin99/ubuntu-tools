#smbmount   //120.116.24.4/webworker ~/mount-path/w4  -o username=webworker,iocharset=utf8 

#gvfs-mount smb://webworker@120.116.24.4/webworker
#sudo mount  //120.116.24.4/webworker ~/mount-path/w4  -o file_mode=0777,dir_mode=0777,uid=1000,username=webworker,iocharset=utf8,sec=lanman
sudo mount  //120.116.24.6/webworker ~/mount-path/vm  -o file_mode=0777,dir_mode=0777,uid=1000,gid=1000,username=webworker,iocharset=utf8