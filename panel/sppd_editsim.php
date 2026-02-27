<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";
$id_spd = addslashes($_POST['id_spd']);
$no_spd = addslashes($_POST['no_spd']);
$id_spt = addslashes($_POST['id_spt']);
$no_spt = addslashes($_POST['no_spt']);
$tgl_spd = addslashes($_POST['tgl_spd']);
$asal = addslashes($_POST['asal']);
$kota_tujuan = addslashes($_POST['tujuan']);
$tgl_berangkat = addslashes($_POST['tgl_berangkat']);
$tgl_kembali = addslashes($_POST['tgl_kembali']);
$tgl_kembali_print = addslashes($_POST['tgl_kembali_print']);
$lama_perjalanan = addslashes($_POST['lama']);
$instansi = addslashes($_POST['instansi']);
$mata_anggaran = addslashes($_POST['mata_anggaran']);
$tahun_anggaran = addslashes($_POST['tahun']);
$keterangan = addslashes($_POST['keterangan']);

$tiba_di_1 = addslashes($_POST['tiba_di_1']);
$pada_tgl_1 = addslashes($_POST['pada_tgl_1']);
$berangkat_dari_1 = addslashes($_POST['berangkat_dari_1']);
$ke_1 = addslashes($_POST['ke_1']);
$pada_tgl_11 = addslashes($_POST['pada_tgl_11']);

$tiba_di_2 = addslashes($_POST['tiba_di_2']);
$pada_tgl_2 = addslashes($_POST['pada_tgl_2']);
$berangkat_dari_2 = addslashes($_POST['berangkat_dari_2']);
$ke_2 = addslashes($_POST['ke_2']);
$pada_tgl_22 = addslashes($_POST['pada_tgl_22']);

$tiba_di_3 = addslashes($_POST['tiba_di_3']);
$pada_tgl_3 = addslashes($_POST['pada_tgl_3']);
$berangkat_dari_3 = addslashes($_POST['berangkat_dari_3']);
$ke_3 = addslashes($_POST['ke_3']);
$pada_tgl_33 = addslashes($_POST['pada_tgl_33']);

$transportasi = isset($_POST['transportasi']) ? $_POST['transportasi'] : array();
$ttd = addslashes($_POST['ttd']);

$sql_cek = mysqli_query($koneksi, "select * from spd where no_spd = '$no_spd'");
$process = mysqli_fetch_array($sql_cek);

$bulan = substr($tgl_berangkat,3,-5);
$tahun_bln = substr($tgl_berangkat,6);

$tahun = date('Y');

$tanggal1 = new DateTime($tgl_berangkat);
$tanggal2 = new DateTime($tgl_kembali);
 
$selisih = $tanggal1->diff($tanggal2)->format("%a");
$selisih_tgl = $selisih +1;

$id_pengikut = isset($_POST['id_pengikut']) ? addslashes($_POST['id_pengikut']) : '';
$pengikut = isset($_POST['pengikut']) ? $_POST['pengikut'] : array();
$pengikut_ = isset($_POST['pengikut_']) ? $_POST['pengikut_'] : array();

    $sql_update = mysqli_query($koneksi, "UPDATE spd SET no_spd = '$no_spd', keterangan_spd = '$keterangan', tahun_anggaran = '$tahun_anggaran', id_kota_tujuan = '$kota_tujuan', tgl_berangkat = '$tgl_berangkat', tgl_kembali = '$tgl_kembali', tgl_kembali_print = '$tgl_kembali_print', lama_perjalanan = '$selisih_tgl', tiba_di_1 = '$tiba_di_1', pada_tgl_1 = '$pada_tgl_1', berangkat_dari_1 = '$berangkat_dari_1', ke_1 = '$ke_1', pada_tgl_11 = '$pada_tgl_11', tiba_di_2 = '$tiba_di_2', pada_tgl_2 = '$pada_tgl_2', berangkat_dari_2 = '$berangkat_dari_2', ke_2 = '$ke_2', pada_tgl_22 = '$pada_tgl_22', tiba_di_3 = '$tiba_di_3', pada_tgl_3 = '$pada_tgl_3', berangkat_dari_3 = '$berangkat_dari_3', ke_3 = '$ke_3', pada_tgl_33 = '$pada_tgl_33', bulan = '$bulan', tahun = $tahun_bln, ttd = '$ttd', mata_anggaran = '$mata_anggaran' WHERE id_spd = '$id_spd'");


	foreach ($pengikut as $ikut) {
    		
    		//$sql_kw = mysqli_query($koneksi, " INSERT INTO kwitansi VALUES ('','','$id_spt','','$ikut','','','','$tahun','','','','','0','N')");
    	}

  foreach ($pengikut as $ikut) {  
      
      //$sql2= mysqli_query($koneksi, "UPDATE spd SET pengikut = '$ikut' WHERE id_pengikut = '$id_pengikut' ");    
    }

  if (is_array($pengikut_)) {
    foreach ($pengikut_ as $ikut_) {  
      //$sql2= mysqli_query($koneksi, "INSERT INTO pengikut VALUES ('','$id_spt','$ikut_')");    
    }
  }

     if (!empty($transportasi) && is_array($transportasi)) {
    	    mysqli_query($koneksi, "DELETE FROM spd_transportasi WHERE no_spd = '$id_spd'");
    		foreach ($transportasi as $transport) {				
		    mysqli_query($koneksi, "INSERT INTO spd_transportasi VALUES (NULL,'$id_spd','$transport')");
   		}
	}

   if ($sql_update){
   		echo "<script type='text/javascript'> document.location = '?page=spe&id=$id_spd&msg=1'; </script>";
	}else{    	
    	echo "<script type='text/javascript'> document.location = '?page=spe&id=$id_spd&msg=2'; </script>";
	}

?>