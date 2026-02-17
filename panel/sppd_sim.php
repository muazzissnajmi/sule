<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";

$query = "SELECT max(id_spd) as maxKode FROM spd";
$hasil = mysqli_query($koneksi, $query);
$data  = mysqli_fetch_array($hasil);
$kode = $data['maxKode'];

$noUrut = (int) substr($kode, 3, 5);
$noUrut++;
$char = "SPD";
$id_spd = $char . sprintf("%05s", $noUrut);

//$id_spd = addslashes($_POST['id_spd']);
$no_spd = addslashes($_POST['no_spd']);
$id_spt = addslashes($_POST['id_spt']);
$no_spt = addslashes($_POST['no_spt']);
$tgl_spd = addslashes($_POST['tgl_spd']);
$asal = addslashes($_POST['asal']);
$kota_tujuan = addslashes($_POST['tujuan']);
$tgl_berangkat = addslashes($_POST['tgl_berangkat']);
$tgl_kembali = addslashes($_POST['tgl_kembali']);
$lama_perjalanan = addslashes($_POST['lama']);
$instansi = addslashes($_POST['instansi']);
$mata_anggaran = addslashes($_POST['mata_anggaran']);
$tahun_anggaran = addslashes($_POST['tahun']);
$keterangan = addslashes($_POST['keterangan']);

$tiba_di_1 = addslashes($_POST['tiba_di_1']);
$pada_tgl_1 = addslashes($_POST['pada_tgl_1']);
$berangakat_dari_1 = addslashes($_POST['berangakat_dari_1']);
$ke_1 = addslashes($_POST['ke_1']);
$pada_tgl_11 = addslashes($_POST['pada_tgl_11']);

$tiba_di_2 = addslashes($_POST['tiba_di_2']);
$pada_tgl_2 = addslashes($_POST['pada_tgl_2']);
$berangakat_dari_2 = addslashes($_POST['berangakat_dari_2']);
$ke_2 = addslashes($_POST['ke_2']);
$pada_tgl_22 = addslashes($_POST['pada_tgl_22']);

$tiba_di_3 = addslashes($_POST['tiba_di_3']);
$pada_tgl_3 = addslashes($_POST['pada_tgl_3']);
$berangakat_dari_3 = addslashes($_POST['berangakat_dari_3']);
$ke_3 = addslashes($_POST['ke_3']);
$pada_tgl_33 = addslashes($_POST['pada_tgl_33']);

$transportasi = $_POST['transportasi'];
$ttd = addslashes($_POST['ttd']);

$sql_cek = mysqli_query($koneksi, "select * from spd where no_spd = '$no_spd'");
$process = mysqli_fetch_array($sql_cek);

$bulan = substr($tgl_berangkat,3,-5);
$tahun_bln = substr($tgl_berangkat,6);

$tahun = date('Y');

$tanggal1 = date_create($tgl_berangkat);
$tanggal2 = date_create($tgl_kembali);
 
$selisih = $tanggal1->diff($tanggal2)->format("%a");
$selisih_tgl = $selisih +1;

$pengikut = $_POST['pengikut'];
   
			
		$sql = mysqli_query($koneksi, "INSERT INTO spd VALUES ('$id_spd','$no_spd','$tgl_spd','$id_spt','$asal','$kota_tujuan','$tgl_berangkat','$tgl_kembali','NULL','$selisih_tgl','$instansi','$mata_anggaran','$tahun_anggaran','$keterangan','$tiba_di_1','$pada_tgl_1','$berangakat_dari_1','$ke_1','$pada_tgl_11','$tiba_di_2','$pada_tgl_2','$berangakat_dari_2','$ke_2','$pada_tgl_22','$tiba_di_3','$pada_tgl_3','$berangakat_dari_3','$ke_3','$pada_tgl_33','$ttd','N','$bulan','$tahun_bln')");

		
		$sql_spt = mysqli_query($koneksi, "UPDATE spt SET cek_spt = 'O' WHERE id_spt= '$id_spt'");

		/*    	
    	foreach ($pengikut as $ikut) {
    		
    		$sql_kw = mysqli_query($koneksi, " INSERT INTO kwitansi VALUES ('','','$id_spt','','$ikut','','','','$tahun','','','','','0','N')");
    	}*/

		foreach ($transportasi as $transport) {	
				
		    $sql2= mysqli_query($koneksi, "INSERT INTO spd_transportasi VALUES (NULL,'$id_spd','$transport')");		
		}

		if ($sql){
			echo "<script type='text/javascript'> document.location = '?page=sppd&msg=3'; </script>";
		}else{    	
	    	echo "<script type='text/javascript'> document.location = '?page=spd&msg=2'; </script>";
		}

?>