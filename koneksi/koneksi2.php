<?php

$server = "localhost";
$username = "root";
$password = "root";
$database = "sule";

$connect = mysqli_connect($server, $username, $password, $database)
	or die('Koneksi gagal: ' . mysqli_connect_error());

mysqli_set_charset($connect, "utf8");

?>