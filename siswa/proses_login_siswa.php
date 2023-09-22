<?php
session_start();
$_SESSION['nis'] = NULL;
extract($_POST);
include "../koneksi.php";
			
			$pass = md5($password);
			$qry	= mysqli_query($c,"SELECT * FROM akun_siswa 
					WHERE nis = '$nis' AND password = '$pass'");
			$jum	= mysqli_num_rows($qry);

			if ($jum == 1)
			{
				$data_siswa	= mysqli_fetch_array($qry, MYSQLI_BOTH);
				$_SESSION['nis'] = $data_siswa['nis'];
				$_SESSION['nama'] = $data_siswa['nama'];
				echo "<script>alert('Anda berhasil Log In');</script>";
				echo "<meta http-equiv='refresh' content='0; url=../index.php'>";
			}
			else
			{
				echo "<meta http-equiv='refresh' content='0; url=login_siswa.php'>";
				echo "<script>alert('Anda Gagal Log In');</script>";
			}
		
		
	
?>