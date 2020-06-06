<?php
if(copy('local/file.img', 'ftp://user:password@ftp.example.com/remote/dir/file.img')) {
  echo "It worked!!!";
}

?>