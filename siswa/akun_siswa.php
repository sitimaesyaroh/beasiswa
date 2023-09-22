<?php
    include "koneksi.php";
    $nis=$_SESSION['nis'];
    $cek = mysqli_query($c,"select * from akun_siswa where nis='$nis'");
    
        $data = mysqli_fetch_array($cek);
        $a = $data['nis'];
        $b = $data['nama'];
?>

<div class="container">
        <div class="row text-center">
            <div class="col">
                <h2>Data Siswa</h2>
            </div>
        </div>
        <div class="row text-right">
            <div class="col">
                
            <form method="post" action="index.php?pg=update_siswa" id='myForm' enctype="multipart/form-data">
                
                <div class="row mb-3">
                    <label for="inputnis" class="col-sm-2 col-form-label">NIM</label>
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control" name="nis" value="<?php echo $a; ?>">
                        <input type="text" class="form-control" id="inputnis" name="nis_baru" required value="<?php echo $a; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputNama" name="nama" required value="<?php echo $b; ?>">
                    </div>
                </div>     
                <a href="index.php?pg=edit_password"><button type="button" class="btn btn-primary" name="edit_password" id="tombol">Edit Password</button></a>
                <button type="submit" class="btn btn-primary" name="update" id="tombol">Update</button>
                <button type="reset" class="btn btn-warning">BATAL</button>
            
            </form>

            </div>
        </div>
</div>
