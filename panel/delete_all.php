<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";

	$sql1 = mysqli_query($koneksi, "DELETE FROM kwitansi");
	$sql2 = mysqli_query($koneksi, "DELETE FROM kwitansi_nilai");
	$sql3 = mysqli_query($koneksi, "DELETE FROM dokumen");
	$sql4 = mysqli_query($koneksi, "DELETE FROM lpd");
	$sql5 = mysqli_query($koneksi, "DELETE FROM pengikut");
	$sql6 = mysqli_query($koneksi, "DELETE FROM spd");
	$sql7 = mysqli_query($koneksi, "DELETE FROM spt");
	$sql7 = mysqli_query($koneksi, "DELETE FROM spd_transportasi");

	$tahun = date('Y');

	$sql8= mysqli_query($koneksi, "UPDATE pagu SET pagu_lk_akhir = '0', pagu_lk_akhir = 'pagu_lk_akhir', pagu_lk_kdh_akhir = '0', pagu_dk_kdh_akhir = '0' WHERE tahun = '$tahun'");
	
	echo "<script type='text/javascript'> document.location = '?page=home'; </script>";


?>
