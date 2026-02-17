<?php //error_reporting(0); 
/*function xss_filter($val) {
$val = htmlentities($val);
$val = strip_tags($val);
$val = filter_var($val, FILTER_SANITIZE_STRING);
return $val;
}*/
?>
<?php
//session_start();
$sql_cek = "SELECT * FROM users WHERE username= '$username'";
//$qry_cek = mysqli_query($koneksi, $sql_cek) or die (header("location: ../index.php?msg=1"));
$qry_cek = mysqli_query($koneksi, $sql_cek);
$ada_cek = mysqli_num_rows($qry_cek);
$hls_cek = mysqli_fetch_array($qry_cek);

$aktif = $hls_cek ? $hls_cek['aktif'] : null;

if ($aktif == "N") {
	header('location:logout2.php');

}
else {

	if (!isset($_SESSION['username'])) {
		echo '<script>window.location.assign("../index.php?msg=1")</script>';
	}
}
?>