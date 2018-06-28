#可以允許本機 uid 1000 使用者，有權限讀寫遠端檔案（遠端帳號  comp )
sudo sshfs -o allow_other,uid=1000,gid=1000 comp@120.116.24.1:/btrfs_data/ ~/mount-path/ftp-mail
