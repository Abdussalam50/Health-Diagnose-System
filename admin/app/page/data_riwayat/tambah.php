
<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI KEHALAMAN SEBELUMNYA'); ?>
</a>	

    <div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Tambah Data Riwayat </strong>
        <hr class="message-inner-separator">
            <p>Silahkan input Data Riwayat  dibawah ini.</p>
        </div>
    </div>

<div class="content-box">
    <form action="proses_simpan.php" enctype="multipart/form-data"  method="post">
        <div class="content-box-content">
            <div id="postcustom">	
                <table <?php tabel_in(100, '%', 0, 'center'); ?>>		
                    <tbody>
                        <!--h
                        <tr>
                            <td width="25%" class="leftrowcms">					
                                <label >Id Riwayat  <span class="highlight">*</span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                              <?php echo id_otomatis("data_riwayat", "id_riwayat", "10"); ?>  		
                            </td>
                        </tr>
                        h-->
                        <input type="hidden" class="form-control" readonly value="<?php echo id_otomatis("data_riwayat", "id_riwayat", "10"); ?>" name="id_riwayat" placeholder="Id Riwayat " id="id_riwayat" required="required">

                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Kode Pasien  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="kode_pasien" id="kode_pasien" placeholder="Kode Pasien " required="required">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Tekanan Darah  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="tekanan_darah" id="tekanan_darah" placeholder="Tekanan Darah " required="required">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Detak Jantung  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="detak_jantung" id="detak_jantung" placeholder="Detak Jantung " required="required">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Suhu Tubuh  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="suhu_tubuh" id="suhu_tubuh" placeholder="Suhu Tubuh " required="required">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Diagnosa  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="diagnosa" id="diagnosa" placeholder="Diagnosa " required="required">
                                <option></option><?php combo_enum('data_riwayat','diagnosa',''); ?>
                                </select>
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Waktu  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="datetime-local" name="waktu" id="waktu" placeholder="Waktu " required="required">
                            </td>
                        </tr>
                        
                
                        
                    </tbody>
                </table>
                <div class="content-box-content">
                    <center>
                        <?php btn_simpan(' PROSES SIMPAN DATA'); ?>
                    </center>
                </div>		
            </div>
        </div>
    </form>
