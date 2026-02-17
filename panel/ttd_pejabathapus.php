<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";

	$sql = mysqli_query($koneksi, "DELETE FROM ttd_pejabat WHERE nip_pejabat = '$_GET[id]'");
	echo "<script type='text/javascript'> document.location = '?page=ttd_pejabat&msg=1'; </script>";

?>
