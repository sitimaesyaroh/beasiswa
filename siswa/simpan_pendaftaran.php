<?php
    include "koneksi.php";
    extract($_POST);
    $tgl=date("Y-m-d");
    if(isset($simpan)){
        $file = $_FILES['berkas'];

        // Dapatkan informasi tentang file yang diunggah
        $fileSize = $file['size'];

        if ($fileSize == 0) {
            echo "<script>alert('Berkas Harus Diisi. Silahkan Ulangi');</script>";
            echo "<meta http-equiv='refresh' content='0; url=index.php?pg=pendaftaran'>";
        }
        else {
            $uploadDir = "siswa/FileBerkas/";
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = $file['name'];
            $allowedFileExtensions = ['pdf','jpg','png']; // extensi yang di izinkan
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);

            if(in_array($ext,$allowedFileExtensions)){
                $newFileName = $nis."." . pathinfo($fileName, PATHINFO_EXTENSION); //merubah nama file menjadi $nis
                $destination = $uploadDir . $newFileName;

                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    echo "File berhasil diunggah.";
                } else {
                    echo "Terjadi kesalahan saat mengunggah file.";
                }

                $perintah = mysqli_query($c,"insert into tb_daftar values(null,'$tgl','$nis','$email','$no_hp','$semester','$ipk','$pil_beasiswa','$newFileName','B','0')");
                if($perintah){
                    echo "<script>alert('File berhasil diunggah dan Anda Berhasil Melakukan Pendaftaran.');</script>";
                    echo "<meta http-equiv='refresh' content='0; url=index.php?pg=pendaftaran'>";
                }
                else {
                    echo "<script>alert('Maaf Anda Gagal Melakukan Pendaftaran. Silahkan Ulangi Kembali!');</script>";
                    echo "<meta http-equiv='refresh' content='0; url=index.php?pg=pendaftaran'>";
                }
                
            }else{
                echo "<script>alert('File yang diperbolehkan hanya PDF, JPG dan PNG');</script>";
                echo "<meta http-equiv='refresh' content='0; url=index.php?pg=pendaftaran'>";
            }
        }

        
    }
