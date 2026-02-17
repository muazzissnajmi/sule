<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";
$sql = "SELECT * FROM spd WHERE id_spd = '$_GET[id]'";
$tampil = mysqli_query($koneksi, $sql);     
$data = mysqli_fetch_array($tampil);
$id_spt = $data['id_spt'];


$sql1= mysqli_query($koneksi, "UPDATE spt SET cek_spt = 'Y' WHERE id_spt = '$id_spt'");
$sql2 = mysqli_query($koneksi, "DELETE FROM spd WHERE id_spd = '$_GET[id]'");
$sql3 = mysqli_query($koneksi, "DELETE FROM spd_transportasi WHERE no_spd = '$_GET[id]'");

	if ($sql2){
    	echo "<script type='text/javascript'> document.location = '?page=sppd&msg=1'; </script>";
	}else{
		echo "<script type='text/javascript'> document.location = '?page=sppd&msg=2'; </script>";
	}

?>
