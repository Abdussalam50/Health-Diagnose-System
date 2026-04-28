<?php
function daftar(){
?>
<br>
<center><h2> DAFTAR  </h2></center>
<br>

<div class="container">
<div class="col-md-12">
<div class="col-md-2">
</div>
<div class="col-md-8">
<center>
Sudah Memiliki akun Silahkan login 
<br><a href="index.php?p=login" class="btn btn-danger">Halaman Login</a>
</center>
<br>
<?php 

//KODE OTOMATIS	 	
function autonumber($id_terakhir, $panjang_kode, $panjang_angka) {
	$kode = substr($id_terakhir, 0, $panjang_kode);
	$angka = substr($id_terakhir, $panjang_kode, $panjang_angka);
	$angka_baru = str_repeat("0", $panjang_angka - strlen($angka+1)).($angka+1);
	$id_baru = $kode.$angka_baru;
	return $id_baru;
}
global $con_mysqli;
$cek = mysqli_query($con_mysqli,"SELECT * FROM data_pasien");
$rowcek = mysqli_num_rows($cek);
if ($rowcek > 0) {
	$id_pasien = mysqli_query($con_mysqli,"SELECT max(id_pasien) as id_pasien FROM data_pasien");
	$data_pasien = mysqli_fetch_array($id_pasien);
	$id_pasien_akhir = $data_pasien['id_pasien'];
	$id_pasien_otomatis = autonumber($id_pasien_akhir, 3, 3); 
	}else{
	$kodedepan = strtoupper('data_pasien');
	$kodedepan = str_replace("DATA_","",$kodedepan);
	$kodedepan = str_replace("DATA","",$kodedepan);
	$kodedepan = str_replace("TABEL_","",$kodedepan);
	$kodedepan = str_replace("TABEL","",$kodedepan);
	$kodedepan = str_replace("TABLE_","",$kodedepan);
	$kodedepan = strtoupper(substr($kodedepan,0,3));
	$id_pasien_otomatis = $kodedepan."001";	
}

?>

<form method="post" action="index.php?p=login&action=simpan_daftar">
<table <?php tabel_in(100,'%',0,'center');  ?>>		
	<tbody>
			   <tr>
				<td width="25%" class="leftrowcms">					
				<label >id&nbsp;pasien <span class="highlight">*</span></label>
			   </td>
				<td width="2%">:</td>
				<td>
				<input type="readonly" class="form-control" readonly value="<?php echo $id_pasien_otomatis;?>" name="id_pasien" placeholder="id_pasien" id="id_pasien" required="required">		
				</td>
			   </tr>
			   
			   <tr>
				<td width="25%" class="leftrowcms">					
				<label >nama&nbsp;pasien <span class="highlight">*</span></label>
			   </td>
				<td width="2%">:</td>
				<td>
				<input type="text"  class="form-control" name="nama_pasien" id="nama_pasien" placeholder="nama&nbsp;pasien" required="required">

		
				</td>
			   </tr>
			   <tr>
				<td width="25%" class="leftrowcms">					
				<label >alamat <span class="highlight">*</span></label>
			   </td>
				<td width="2%">:</td>
				<td>
				<textarea class="form-control" class='ckeditor'   class="form-control" type="textarea" name="alamat" id="alamat" placeholder="alamat" required="required">

</textarea>		
				</td>
			   </tr>
			   <tr>
				<td width="25%" class="leftrowcms">					
				<label >jenis&nbsp;kelamin <span class="highlight">*</span></label>
			   </td>
				<td width="2%">:</td>
				<td>
				<!--<select  class='form-control selectpicker' data-live-search='true' -->
<select  type="enum" name="jenis_kelamin"  class="form-control" id="jenis_kelamin" placeholder="jenis&nbsp;kelamin" required="required">
<option>laki-laki</option>
<option>perempuan</option>
</select>		
				</td>
			   </tr>
			   <tr>
				<td width="25%" class="leftrowcms">					
				<label >no&nbsp;telepon <span class="highlight">*</span></label>
			   </td>
				<td width="2%">:</td>
				<td>
				<input type="number"  class="form-control" name="no_telepon" id="no_telepon" placeholder="no&nbsp;telepon" required="required">

		
				</td>
			   </tr>
			   <tr>
				<td width="25%" class="leftrowcms">					
				<label >email <span class="highlight">*</span></label>
			   </td>
				<td width="2%">:</td>
				<td>
				<input type="text"  class="form-control" name="email" id="email" placeholder="email" required="required">

		
				</td>
			   </tr>
			   <tr>
				<td width="25%" class="leftrowcms">					
				<label >username <span class="highlight">*</span></label>
			   </td>
				<td width="2%">:</td>
				<td>
				<input type="text"  class="form-control" name="username" id="username" placeholder="username" required="required">

		
				</td>
			   </tr>
			   <tr>
				<td width="25%" class="leftrowcms">					
				<label >password <span class="highlight">*</span></label>
			   </td>
				<td width="2%">:</td>
				<td>
				<input type="password"   class="form-control" name="password" id="password" placeholder="password" required="required">

		
				</td>
			   </tr>
			   
	</tbody>
</table>
<div class="content-box-content">
<center>
<?php btn_simpan(' DAFTAR'); ?>
</center>
</div>		
</form>
</div>
</div>
</div>
<br><br><br><br>
<?php 
}
function simpan_daftar()
{
	if (!isset($_POST['id_pasien']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 
$id_pasien=$_POST['id_pasien'];
$nama_pasien=$_POST['nama_pasien'];
$alamat=$_POST['alamat'];
$jenis_kelamin=$_POST['jenis_kelamin'];
$no_telepon=$_POST['no_telepon'];
$email=$_POST['email'];
$username=$_POST['username'];
$password= md5($_POST['password']);

$query=mysql_query("insert into data_pasien values (
'$id_pasien'
 ,'$nama_pasien'
 ,'$alamat'
 ,'$jenis_kelamin'
 ,'$no_telepon'
 ,'$email'
 ,'$username'
 ,'$password'

)");

if($query){
?>
<script>
alert ("PENDAFTARAN BERHASIL, SILAHKAN LOGIN");
location.href = "<?php index(); ?>?p=login"; </script>
<?php
}
else
{
	echo "GAGAL DIPROSES";
}
}
?>