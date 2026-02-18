<?php
ob_start();
session_start();
if (!isset($_SESSION['submit']) || $_SESSION['submit'] !== TRUE) {
	header("location: index.php");
	exit();
}

// Tentukan halaman tujuan berdasarkan role
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

if ($role == 'admin' || $role == 'superadmin') {
	header("location: panel/?page=home");
	exit();
}
else {
	header("location: panel/?page=home");
	exit();
}
?>