<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";
	$id = $_GET['id'];
	$sql = mysqli_query($koneksi, "DELETE FROM kwitansi WHERE id_spt = '$id'");
	echo "<script type='text/javascript'> document.location = '?page=kwitansi'; </script>";

?>
