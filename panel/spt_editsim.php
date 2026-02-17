<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";
$id_spt = addslashes($_POST['id_spt']);
$no_spt = addslashes($_POST['no_spt']);
$tgl_spt = addslashes($_POST['tgl_spt']);
$memberi_perintah = addslashes($_POST['memberi_perintah']);
$pejabat_berwenang = addslashes($_POST['pejabat_berwenang']);
$id_pengikut = addslashes($_POST['id_pengikut']);
$pengikut = $_POST['pengikut'];
$pengikut_ = $_POST['pengikut_'];
$dasar_penugasan = addslashes($_POST['dasar_penugasan']);
$keterangan = addslashes($_POST['keterangan']);
$ttd = addslashes($_POST['ttd']);
$spd = addslashes($_POST['spd']);

    $sql= mysqli_query($koneksi, "UPDATE spt SET no_spt = '$no_spt', tgl_spt = '$tgl_spt', berwenang = '$pejabat_berwenang', dasar_penugasan = '$dasar_penugasan', keterangan = '$keterangan', ttd_ub = '$ttd' WHERE id_spt = '$id_spt'");
    $sql_spd = mysqli_query($koneksi, "UPDATE spd SET tgl_spd = '$tgl_spt' WHERE id_spt = '$id_spt'");
    $sql_kw = mysqli_query($koneksi, "UPDATE kwitansi SET tgl_spt = '$tgl_spt' WHERE id_spt = '$id_spt'");

   
    	    	    
	    if ($pengikut == '') {

	    }else{
	    	$sql = mysqli_query($koneksi, "DELETE FROM pengikut WHERE no_spt = '$id_spt'");
	    		
		}
    
   if ($sql){
   		foreach ($pengikut as $ikut) {
   			$sql2= mysqli_query($koneksi, "INSERT INTO pengikut VALUES (NULL,'$id_spt','$ikut')");
   			//$sql = mysqli_query($koneksi, "DELETE FROM kwitansi WHERE id_spt = '$id_spt'");
   		}
      foreach ($pengikut_ as $ikut_) {  
      
      $sql2= mysqli_query($koneksi, "INSERT INTO pengikut VALUES (NULL,'$id_spt','$ikut_')");    
    }
    	echo "<script type='text/javascript'> document.location = '?page=se&id=$id_spt&msg=1'; </script>";
	}else{
		echo "<script type='text/javascript'> document.location = '?page=se&id=$id_spt&msg=2'; </script>";
	}

?>