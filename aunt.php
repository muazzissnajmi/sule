<?php
ob_start();
session_start();
include "koneksi/koneksi.php";

if (isset($_POST['submit'])) {

	// terima data dari form login
	$username = htmlspecialchars(trim($_POST['username']));
	$password = htmlspecialchars(trim($_POST['password']));

	// untuk mencegah sql injection
	$username = mysqli_real_escape_string($koneksi, $username);

	//perintah login
	$sql_cek = "SELECT * FROM users WHERE BINARY username= '$username'";
	$qry_cek = mysqli_query($koneksi, $sql_cek);

	if (!$qry_cek) {
		// Query gagal - redirect ke index dengan pesan error
		header("location: index.php?msg=2");
		exit();
	}

	$ada_cek = mysqli_num_rows($qry_cek);
	$hls_cek = mysqli_fetch_array($qry_cek);

	$aktif = isset($hls_cek['aktif']) ? $hls_cek['aktif'] : '';
	$tgl = date('l, d-m-Y h:i');

	//membaca password terenkripsi md5
	if (md5($password) == $hls_cek['password'] && $ada_cek >= 1 && $aktif == "Y") {

		// kalau username dan password sudah terdaftar di database
		// buat session dengan nama username dengan isi nama user yang login
		$_SESSION['username'] = $username;
		$_SESSION['id_divisi'] = $hls_cek['id_divisi'];
		$_SESSION['id_outlet'] = $hls_cek['id_outlet'];
		$_SESSION['role'] = $hls_cek['role'];
		$_SESSION['submit'] = TRUE;

		//cek remember me
		if (isset($_POST['remember'])) {
			$time = time();
			setcookie('submit', $username, $time + 43200);
		}

		// redirect ke halaman panel
		header("location: redirect.php");
		exit();

	}
	elseif ($aktif == "N") {
		header("location: index.php?msg=3");
		exit();

	}
	else {
		// kalau username ataupun password tidak terdaftar di database
		header("location: index.php?msg=2");
		exit();
	}

}
else {
	// Jika diakses langsung tanpa POST, redirect ke halaman login
	header("location: index.php");
	exit();
}
?>