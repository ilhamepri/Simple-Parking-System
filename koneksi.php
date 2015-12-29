<?php
$kon=mysql_connect("localhost","root","luver");
if(!$kon)
echo "Koneksi ke db gagal, ".mysql_error();
mysql_select_db("parkir",$kon);
?>