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


$id_riwayat = id_otomatis("data_riwayat", "id_riwayat", "10");
              $kode_pasien=xss($_POST['kode_pasien']);
              $tekanan_darah=xss($_POST['tekanan_darah']);
              $detak_jantung=xss($_POST['detak_jantung']);
              $suhu_tubuh=xss($_POST['suhu_tubuh']);
              $diagnosa=xss($_POST['diagnosa']);
              $waktu=xss($_POST['waktu']);


$query = mysql_query("insert into data_riwayat values (
'$id_riwayat'
 ,'$kode_pasien'
 ,'$tekanan_darah'
 ,'$detak_jantung'
 ,'$suhu_tubuh'
 ,'$diagnosa'
 ,'$waktu'

)");

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
