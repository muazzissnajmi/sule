<?php
error_reporting(0);

$server = "localhost";
$username = "root";
$password = "root";
$database = "sule";

$koneksi = mysqli_connect($server, $username, $password, $database)
    or die('Koneksi gagal: ' . mysqli_connect_error());

mysqli_set_charset($koneksi, "utf8");

?>