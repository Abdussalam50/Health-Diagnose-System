
<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI'); ?>
</a>

<br><br>

<div class="content-box">
    <div class="content-box-content">
        <table <?php tabel_in(100, '%', 0, 'center'); ?>>		
            <tbody>
               
                <?php
                if (!isset($_GET['proses'])) {
                        
                    ?>
                <script>
                    alert("AKSES DITOLAK");
                    location.href = "index.php";
                </script>
                <?php
                die();
            }
            $proses = decrypt(mysql_real_escape_string($_GET['proses']));
            $sql = mysql_query("SELECT * FROM data_riwayat where id_riwayat = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id Riwayat </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_riwayat']; ?></td>	
            </tr>
           h-->

            <tr>
                <td class="clleft" width="25%">Kode Pasien </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['kode_pasien']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Tekanan Darah (Sistolik) </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['sistolik']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Tekanan Darah (Diastolik)</td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['diastolik']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Detak Jantung </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['detak_jantung']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Suhu Tubuh </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['suhu_tubuh']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Diagnosa </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['diagnosa']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Waktu </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['waktu']; ?></td>
            </tr>




            </tbody>
        </table>
    </div>
</div>
