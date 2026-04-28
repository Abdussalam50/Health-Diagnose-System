
<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI KE HALAMAN SEBELUMNYA'); ?>
</a>

    <div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Edit Data Riwayat </strong>
        <hr class="message-inner-separator">
            <p>Silahkan Update Data Riwayat  dibawah ini.</p>
        </div>
    </div>


<div class="content-box">
    <form action="proses_update.php"  enctype="multipart/form-data"  method="post">
        <div class="content-box-content">
            <div id="postcustom">	
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
                        <td width="25%" class="leftrowcms">					
                            <label >Id Riwayat  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php echo $data['id_riwayat']; ?>	
                        </td>
                    </tr>
                    h-->
                    <input type="hidden" class="form-control" name="id_riwayat" value="<?php echo $data['id_riwayat']; ?>" readonly  id="id_riwayat" required="required">

                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Kode Pasien  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="kode_pasien" id="kode_pasien" placeholder="Kode Pasien " required="required" value="<?php echo ($data['kode_pasien']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Tekanan Darah  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="tekanan_darah" id="tekanan_darah" placeholder="Tekanan Darah " required="required" value="<?php echo ($data['tekanan_darah']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Detak Jantung  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="detak_jantung" id="detak_jantung" placeholder="Detak Jantung " required="required" value="<?php echo ($data['detak_jantung']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Suhu Tubuh  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="suhu_tubuh" id="suhu_tubuh" placeholder="Suhu Tubuh " required="required" value="<?php echo ($data['suhu_tubuh']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Diagnosa  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="diagnosa" id="diagnosa" placeholder="Diagnosa " required="required">
                                <option value="<?php echo ($data['diagnosa']); ?>">- <?php echo ($data['diagnosa']); ?> -</option><?php combo_enum('data_riwayat','diagnosa',''); ?>
                                </select>
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Waktu  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input value="<?php echo ($data['waktu']); ?>" class="form-control" style="width:50%" type="text" name="waktu" id="waktu" placeholder="Waktu " required="required">
                            </td>
                        </tr>


                    </tbody>
                </table>
                <div class="content-box-content">
                    <center>
                        <?php btn_update(' PROSES UPDATE DATA'); ?>
                    </center>
                </div>		
            </div>
        </div>
    </form>
