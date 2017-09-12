#smbmount   //120.116.24.1/webworker ~/mount-path/dns-web  -o username=webworker,iocharset=utf8 

#gvfs-mount ftp://webworker@120.116.24.1   ,sec=lanman

sudo mount  //120.116.24.1/webworker ~/mount-path/dns  -o file_mode=0777,dir_mode=0777,uid=1000,username=webworker,iocharset=utf8