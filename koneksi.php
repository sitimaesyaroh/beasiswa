<?php
	$host="localhost";
	$user="root";
	$pass="";
	$database="db_beasiswa";
	$c=mysqli_connect($host,$user,$pass,$database);
	if (mysqli_connect_error()) {
	  trigger_error('Koneksi ke database gagal: '  . mysqli_connect_error(), E_USER_ERROR); 
	}
?>