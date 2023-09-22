<?php
    include "koneksi.php";
    extract($_GET);
    $nis=$_SESSION['nis'];
    $nama=$_SESSION['nama'];
    $cek = mysqli_query($c,"select * from tb_daftar where nis='$nis'");
    $jml = mysqli_num_rows($cek);
    if($jml==1){
        $data = mysqli_fetch_array($cek);
        $a = $data['id_daftar'];
        $b = $nis;
        $c = $nama;
        $d = $data['email'];
        $e = $data['no_hp'];
        $f = $data['semester'];
        $g = $data['ipk'];
        $h = $data['pil_beasiswa'];
        $i = $data['berkas'];
        $j = $data['status'];        
        $link = "index.php?pg=update_pendaftaran";
        $tombol = "EDIT";

        
        function active_pil_beasiswa($value, $input){
            $result = $value==$input?'selected':'';
            return $result;
        }

        function active_semester($value, $input){
            $result = $value==$input?'selected':'';
            return $result;
        }
        switch($j){
            case "B" : $st="Belum Terverifikasi"; break;
            case "D" : $st="Diterima"; break;
            case "T" : $st="Ditolak"; break;
        }
        
        
    } else {
        $a="";
        $b=$nis;
        $c=$nama;
        $d=$e=$f=$g=$h=$i=$j="";
        
        function active_pil_beasiswa($value='A', $input){
            $result = $value==$input?'selected':'';
            return $result;
        }

        function active_semester($value='1', $input){
            $result = $value==$input?'selected':'';
            return $result;
        }

        $link = "index.php?pg=simpan_pendaftaran";
        $tombol = "SIMPAN";
    }
?>

<div class="container">
        <div class="row text-center">
            <div class="col">
                <h2>Data Pendaftaran Beasiswa</h2>
            </div>
        </div>
        <div class="row text-right">
            <div class="col">
                
            <form method="post" action="<?php echo $link; ?>" id='myForm' enctype="multipart/form-data">
                <div class="row mb-3">
                    <label for="inputNIM" class="col-sm-2 col-form-label">NIM</label>
                    <div class="col-sm-10">
                    <input type="hidden" class="form-control" name="id" value="<?php echo $a; ?>">
                        <input type="text" readonly class="form-control" id="inputNIS" name="nis" value="<?php echo $b; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control" id="inputNama" name="nama" value="<?php echo $c; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" name="email" required value="<?php echo $d; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputNoHP" class="col-sm-2 col-form-label">No HP</label>
                    <div class="col-sm-10">
                    <input type="tel" id="phone" class="form-control" name="no_hp" pattern="[0-9]{12,15}" minlength="12" maxlength="15" required value="<?php echo $e; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputSemester" class="col-sm-2 col-form-label">Semester</label>
                    <div class="col-sm-10">
                        <select name="semester" class="form-control">
                                    <option value='1' <?php echo active_semester("1", $f) ?>>1</option>
                                    <option value='2' <?php echo active_semester("2", $f) ?>>2</option>
                                    <option value='3' <?php echo active_semester("3", $f) ?>>3</option>
                                    <option value='4' <?php echo active_semester("4", $f) ?>>4</option>
                                    <option value='5' <?php echo active_semester("5", $f) ?>>5</option>
                                    <option value='6' <?php echo active_semester("6", $f) ?>>6</option>
                                    <option value='7' <?php echo active_semester("7", $f) ?>>7</option>
                                    <option value='8' <?php echo active_semester("8", $f) ?>>8</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputIPK" class="col-sm-2 col-form-label">IPK Terakhir</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="ipk" name="ipk" required value="<?php echo $g; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputPilBeasiswa" class="col-sm-2 col-form-label">Pilihan Beasiswa</label>
                    <div class="col-sm-10">
                        <select name="pil_beasiswa" class="form-control" id="pil_beasiswa">
                                    <option value='A' <?php echo active_pil_beasiswa("A", $h) ?>>Akademik</option>
                                    <option value='NA' <?php echo active_pil_beasiswa("NA", $h) ?>>Non Akademik</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputBerkas" class="col-sm-2 col-form-label">Berkas</label>
                    <div class="col-sm-10">
                        <input type="file" name="berkas" class="form-control" id="berkas" <?php if($jml<1) echo "required"; ?>>
                        <?php
                            echo "<a href='lihat_berkas.php?filename=$i' target='_blank'>$i</a>";
                        ?>                        
                    </div>
                </div>

                <?php
                if($jml==1){
                ?>
                 <div class="row mb-3">
                    <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                    <input type="text" name="status" class="form-control" id="status" readonly value="<?php echo "$st"; ?>">
                    </div>
                </div>
                <?php
                }
                ?>
                
            <?php
                if(($j<>"D")||($j<>"T"))
                {
            ?>
                <button type="submit" class="btn btn-primary" name="simpan" id="tombol"><?php echo $tombol; ?></button>
                <button type="reset" class="btn btn-warning">BATAL</button>
            <?php
                }
            ?>
            </form>

            </div>
        </div>
</div>

<script>
    var nilaiIPK = document.getElementById('ipk');
    var pilBeasiswa = document.getElementById('pil_beasiswa');
    var bks = document.getElementById('berkas');
    var tmbl = document.getElementById('tombol');

    nilaiIPK.addEventListener('change', function () {
        if (nilaiIPK.value < 3) {
            pilBeasiswa.disabled = true; // Menonaktifkan
            bks.disabled = true; // Menonaktifkan
            tmbl.disabled = true; // Menonaktifkan
        } else {
            pilBeasiswa.disabled = false; // Mengaktifkan
            bks.disabled = false; // Mengaktifkan
            tmbl.disabled = false; // Mengaktifkan
        }
    });
</script>
