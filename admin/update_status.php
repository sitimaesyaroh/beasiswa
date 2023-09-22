<?php
    include "koneksi.php";
    extract($_POST);
    $id_admin=$_SESSION['id_admin'];
    if(isset($update_status)){
        
        $perintah = mysqli_query($c,"UPDATE tb_daftar 
                    SET status='$status',id_admin='$id_admin'
                    WHERE id_daftar='$id'");
        if($perintah){
            echo "<script>alert('Status $nama Berhasil Diubah');</script>";
            echo "<meta http-equiv='refresh' content='0; url=index.php?pg=pendaftaran'>";
        }
    }

?>
