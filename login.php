<?php
session_start();
include "koneksi.php";
if (isset($_POST['user'])) {
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$a = "SELECT * FROM karyawan WHERE user_kar = '$user' AND password =('$pass') ";
	$b = mysql_query($a) or die (mysql_error());
	$jum = mysql_num_rows($b);
	if($jum == '0'){
		//echo "<script>alert('Login Gagal!!!');</script>";
		echo "<meta http-equiv='refresh' content='1;URL=index.php' />";
	}else{
		$c = mysql_fetch_array($b);
		$_SESSION['Login'] = $c ['user_kar'];
		$_SESSION['pass'] = $c ['password'];
	//echo "<script>alert('Login Berhasil');</script>";
	echo "<meta http-equiv='refresh' content='1;URL=index.php' />";
	}
}
else{
	header("Location: index.php");
}

mysql_close($kon);

?>