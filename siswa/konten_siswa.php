<?php
extract($_GET);
if($pg=="pendaftaran") include "siswa/pendaftaran.php";
elseif($pg=="update_pendaftaran") include "siswa/update_pendaftaran.php";
elseif($pg=="simpan_pendaftaran") include "siswa/simpan_pendaftaran.php";

elseif($pg=="akun_siswa") include "siswa/akun_siswa.php";
elseif($pg=="update_siswa") include "siswa/update_siswa.php";
elseif($pg=="edit_password") include "siswa/edit_password.php";
?>