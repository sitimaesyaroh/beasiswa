<?php
    include "koneksi.php";
    extract($_POST);
    if(isset($simpan)){
        $file = $_FILES['berkas'];

        // Dapatkan informasi tentang file yang diunggah
        $fileSize = $file['size'];

        if ($fileSize == 0) {
            $perintah = mysqli_query($c,"UPDATE tb_daftar 
                    SET email='$email',no_hp='$no_hp',semester='$semester',ipk='$ipk',
                        pil_beasiswa='$pil_beasiswa'
                    WHERE id_daftar='$id'");
        }
        else {
            $uploadDir = "siswa/FileBerkas/";
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = $file['name'];

            $newFileName = $nis."." . pathinfo($fileName, PATHINFO_EXTENSION); //merubah nama file menjadi $nis
            $destination = $uploadDir . $newFileName;

            if (move_uploaded_file($file['tmp_name'], $destination)) {
                echo "File berhasil diunggah.";
            } else {
                echo "Terjadi kesalahan saat mengunggah file.";
            }
            $perintah = mysqli_query($c,"UPDATE tb_daftar 
                    SET email='$email',no_hp='$no_hp',semester='$semester',ipk='$ipk',
                        pil_beasiswa='$pil_beasiswa',berkas='$newFileName'
                    WHERE id_daftar='$id'");
        }
        
        if($perintah){
            echo "<script>alert('Data Berhasil Diupdate');</script>";
            echo "<meta http-equiv='refresh' content='0; url=index.php?pg=pendaftaran'>";
        } else {
            echo "<script>alert('Data Gagal Diupdate');</script>";
            echo "<meta http-equiv='refresh' content='0; url=index.php?pg=pendaftaran'>";
        }

        
        
    }

?>
