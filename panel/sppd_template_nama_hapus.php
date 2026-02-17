<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";

$sql = mysqli_query($koneksi, "DELETE FROM sppd_template WHERE id_nama_pejabat = '$_GET[id]'");

echo "<script type='text/javascript'> document.location = '?page=sppdttn'; </script>";
	

?>
