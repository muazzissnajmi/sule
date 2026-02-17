<?php
//lanjutkan session yang sudah dibuat sebelumnya
session_start();

session_destroy();

if(isset($_COOKIE['submit']))
{
$time = time();
setcookie("login", $time - 3600);
}
//redirect ke halaman login
header('location:../index.php?msg=3');
exit();


?>