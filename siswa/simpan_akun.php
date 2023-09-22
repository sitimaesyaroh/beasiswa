<?php
    include "../koneksi.php";
    extract($_POST);
    if(isset($simpan)){
        $cek_nis = mysqli_query($c,"select * from akun_siswa where nis='$nis'");
        if(mysqli_num_rows($cek_nis)>0){
            echo "<script>alert('Maaf Anda Sudah Terdaftar. Silahkan Login');</script>";
            echo "<meta http-equiv='refresh' content='0; url=login_siswa.php'>";
        } else {
            $pass=md5($password);
            $perintah = mysqli_query($c,"insert into akun_siswa values('$nis','$nama','$pass')");
            if($perintah){
                echo "<script>alert('Akun Berhasil Dibuat. Silahkan Melakukan Login');</script>";
                echo "<meta http-equiv='refresh' content='0; url=login_siswa.php'>";
            }
            else {
                echo "<script>alert('Maaf Akun Gagal Dibuat. Silahkan Ulangi Kembali!');</script>";
                echo "<meta http-equiv='refresh' content='0; url=pendaftaran_akun.php'>";
            }
        }
        
    }
?>