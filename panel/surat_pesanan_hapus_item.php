<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";
	$id = $_GET['id'];
	
	$sql_item_ = "SELECT * FROM pesanan_barang WHERE id_pesanan = '$id'";
    $tampil_item_ = mysqli_query($koneksi, $sql_item_);     
    $data_item_ = mysqli_fetch_array($tampil_item_);
    $kode_pesanan = $data_item_['kode_pesanan_barang'];

	$sql3 = mysqli_query($koneksi, "DELETE FROM pesanan_barang WHERE id_pesanan = '$id'");

	echo "<script type='text/javascript'> document.location = '?page=supe&id=$kode_pesanan&msg=3'; </script>";

?>