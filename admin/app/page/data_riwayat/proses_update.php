<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_riwayat'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_riwayat = xss($_POST['id_riwayat']);
$kode_pasien = xss($_POST['kode_pasien']);
$tekanan_darah = xss($_POST['tekanan_darah']);
$detak_jantung = xss($_POST['detak_jantung']);
$suhu_tubuh = xss($_POST['suhu_tubuh']);
$diagnosa = xss($_POST['diagnosa']);
$waktu = xss($_POST['waktu']);


$query = mysql_query("update data_riwayat set 
kode_pasien='$kode_pasien',
tekanan_darah='$tekanan_darah',
detak_jantung='$detak_jantung',
suhu_tubuh='$suhu_tubuh',
diagnosa='$diagnosa',
waktu='$waktu'

where id_riwayat='$id_riwayat' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
