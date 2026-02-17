<?php //include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";
	$id = $_GET['id'];
	
	
	$sql2 = mysqli_query($koneksi, "DELETE FROM amprahan WHERE id_amprahan = '$id'");
	$sql3 = mysqli_query($koneksi, "DELETE FROM amprahan_detail WHERE id_amprahan = '$id'");


	echo "<script type='text/javascript'> document.location = '?page=sups&msg=1'; </script>";

?>
