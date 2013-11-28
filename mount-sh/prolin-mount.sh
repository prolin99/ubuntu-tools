#smbmount   //120.116.24.1/prolin ~/mount-path/prolin-web  -o username=prolin,iocharset=utf8 

#gvfs-mount ftp://prolin@120.116.24.1

#gvfs-mount smb://prolin\;workgroupname@120.116.24.1/porlin
echo "prolin web :"
sudo mount   //120.116.24.1/prolin ~/mount-path/prolin-web  -o file_mode=0777,dir_mode=0777,uid=1000,username=prolin,iocharset=utf8,sec=lanman