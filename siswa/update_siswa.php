<?php
    include "koneksi.php";
    extract($_POST);
    if(isset($update)){
        
        $_SESSION['nama'] = $nama;
        $_SESSION['nis'] = $nis_baru;

        $perintah = mysqli_query($c,"UPDATE akun_siswa 
                    SET nama='$nama', nis='$nis_baru'
                    WHERE nis='$nis'");
        
        $cek_pendaftaran=mysqli_query($c,"SELECT * FROM tb_daftar
                                         WHERE nis='$nis'");
        if(mysqli_num_rows($cek_pendaftaran)>0){
            $perintah2 = mysqli_query($c,"UPDATE tb_daftar 
                                        SET nis='$nis_baru'
                                        WHERE nis='$nis'");
        }

        if($perintah){
            echo "<script>alert('Data Siswa Berhasil Diubah');</script>";
            echo "<meta http-equiv='refresh' content='0; url=index.php?pg=akun_siswa'>";
        }
    } 
    else if(isset($update_password)){
        $pass = md5($password_baru);
        $perintah = mysqli_query($c,"UPDATE akun_siswa 
                    SET password='$pass'
                    WHERE nis='$nis'");
        if($perintah){
            echo "<script>alert('Password Berhasil Diubah');</script>";
            echo "<meta http-equiv='refresh' content='0; url=index.php?pg=akun_siswa'>";
        }
    } 

?>
