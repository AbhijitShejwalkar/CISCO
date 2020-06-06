<?php 
// On Windows:
$df_c = disk_free_space("C:");
$df_d = disk_free_space("D:");

echo $df_c;
echo $df_d;
?>