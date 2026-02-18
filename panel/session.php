<?php
// session sudah dimulai di panel/index.php
// koneksi dan $username sudah tersedia dari top.php

if (!isset($_SESSION['username'])) {
	echo '<script>window.location.assign("../index.php?msg=1")</script>';
	exit();
}

$username = $_SESSION['username'];

if (isset($koneksi)) {
	$sql_cek = "SELECT aktif FROM users WHERE username= '" . mysqli_real_escape_string($koneksi, $username) . "'";
	$qry_cek = mysqli_query($koneksi, $sql_cek);
	if ($qry_cek) {
		$hls_cek = mysqli_fetch_array($qry_cek);
		$aktif = $hls_cek ? $hls_cek['aktif'] : null;

		if ($aktif == "N") {
			header('location: logout2.php');
			exit();
		}
	}
}
?>