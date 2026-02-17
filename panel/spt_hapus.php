<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";
$sql_ = "SELECT * FROM spt WHERE id_spt = '$_GET[id]'";
$tampil_ = mysqli_query($koneksi, $sql_);     
$data_ = mysqli_fetch_array($tampil_);
$no_spt_ = $data_['no_spt'];

$sql = "SELECT * FROM spd WHERE no_spt = '$no_spt_'";
$tampil = mysqli_query($koneksi, $sql);     
$data = mysqli_fetch_array($tampil);
$no_spt = $data['no_spt'];


$sql3 = mysqli_query($koneksi, "DELETE FROM spt WHERE id_spt = '$_GET[id]'");
$sql4 = mysqli_query($koneksi, "DELETE FROM pengikut WHERE no_spt = '$_GET[id]'");			

	
echo "<script type='text/javascript'> document.location = '?page=spt&msg=1'; </script>";


?>
