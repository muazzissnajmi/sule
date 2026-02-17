<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";
	$id = $_GET['id'];
	
	$sql_item_ = "SELECT * FROM pengikut WHERE id_pengikut = '$id'";
    $tampil_item_ = mysqli_query($koneksi, $sql_item_);     
    $data_item_ = mysqli_fetch_array($tampil_item_);
    $no_spt = $data_item_['no_spt'];

	$sql3 = mysqli_query($koneksi, "DELETE FROM pengikut WHERE id_pengikut = '$id'");

	echo "<script type='text/javascript'> document.location = '?page=se&id=$no_spt'; </script>";

?>