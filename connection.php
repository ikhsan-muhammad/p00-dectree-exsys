<?php
	$server 		= "localhost";
	$user 			= "root";
	$password 		= "";
	$database 		= "c45cf";

	$connection = mysqli_connect($server, $user, $password, $database);

	if(!$connection)
	    die("Koneksi Gagal : " . mysqli_connect_error());
	else
		//echo "Koneksi Berhasil";

?>