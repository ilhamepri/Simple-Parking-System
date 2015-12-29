<?php
session_start();
include "koneksi.php";
if (isset($_POST['user'])) {


	$user = $_POST['user'];
	$name= $_POST['name'];
	$pass = $_POST['pass'];

	if(isset($user,$name,$pass))
	{
	mysql_query("INSERT INTO karyawan VALUES ('$user', '$name', NULL, NULL, NULL, '$pass')");
		echo "<script>alert('Register Berhasil');</script>";
		echo "<meta http-equiv='refresh' content='1;URL=index.php' />";}

}
else{
	header("Location: index.php");
}
?>