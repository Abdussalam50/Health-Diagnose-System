<?php
require_once '../admin/include/function/all.php';
include '../admin/include/function/metode_c.php';
include '../admin/include/koneksi/koneksi.php';
include 'train_data.php';
include '../admin/include/api_key/api_key.php';
date_default_timezone_set('Asia/Jakarta');
if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['api_key'])){

        $api_key=$_GET['api_key'];
        if($api_key!==API_KEY){
            echo json_encode(['response'=>'access denied']);
            die;
        }
    }else{
        echo json_encode(['response'=>'access denied']);
        die;
    }

    $id=id_otomatis('data_riwayat',"id_riwayat",10);
  
    $kode_pasien=kode_pasien();
    $tekanan_darah=$_GET['out_1'];
    $pecahTekDarah=explode(',',$tekanan_darah);
    $sistolik=$pecahTekDarah[0];
    $diastolik=$pecahTekDarah[1];
    $detak_jantung=$_GET['out_2'];
    $suhu=$_GET['out_3'];
    $waktu=date('Y-m-d H:i:s');

    //cek model decision tree terlebih dahulu ada atau tidak
    if(file_exists('../admin/include/function/model_diagnosa.json')){
        $diagnoser=new C45DiagnosticSystem();
        $diagnoser->loadModelFromFile('../admin/include/function/model_diagnosa.json');
        $pecah_tekanandarah=explode(",",$tekanan_darah);
        $tekanan_sistolik=$pecah_tekanandarah[0];
        $detakJantung=$detak_jantung;
        $suhu_tubuh=$suhu;
        $diagnosa=$diagnoser->diagnose($tekanan_sistolik,$detakJantung,$suhu_tubuh);
        echo $diagnosa;
    }else{
        $c45=new C45DiagnosticSystem();
        $c45->setData($data);
        $c45->train();
        $c45->saveModelToFile('../admin/include/function/model_diagnosa.json');
        echo 'machine learning belum siap, silahkan request ulang';
        die;
    }
    // insert database
    $query="INSERT INTO data_riwayat VALUES('$id','$kode_pasien','$sistolik','$diastolik','$detak_jantung','$suhu','$diagnosa','$waktu')";
    $results=mysql_query($query);
    if($results){
        echo json_encode(array('condition'=>'true'));
    }else{
        echo json_encode(array('condition'=>mysql_error()));
    }
}

function kode_pasien(){
    include '../admin/include/koneksi/koneksi.php';
    $query = mysql_query("SELECT * FROM data_riwayat");
    
    if(mysql_num_rows($query) > 0){   
        $queryGet=mysql_query("SELECT * FROM data_riwayat ORDER BY id_riwayat DESC LIMIT 1");
        $data = mysql_fetch_array($queryGet);
        $kode_pasien = $data['kode_pasien']; // Misalnya: PA005
        $number = (int)substr($kode_pasien, 2); // Ambil 3 digit terakhir sebagai angka
        $number++; // Tambah 1
        return 'PA' . str_pad($number, 3, '0', STR_PAD_LEFT); // Format ulang misalnya jadi PA006
    } else {
        return 'PA001'; // Harus string, bukan angka 001
    }
}
