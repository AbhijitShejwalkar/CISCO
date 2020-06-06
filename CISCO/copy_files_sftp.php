<?php
if(copy('local/file.img', 'sftp://user:password@ftp.example.com/remote/dir/file.img')) {
    echo "It worked!!!";
  }
?>