<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";

$sql_ = "SELECT * FROM pengikut WHERE pengikut = '$_GET[id]'";
$tampil_ = mysqli_query($koneksi, $sql_);     
$data_ = mysqli_fetch_array($tampil_);
$pengikut = $data_['pengikut'];

if ($pengikut == $_GET[id]) {	
	echo "<script type='text/javascript'> document.location = '?page=pegawai&msg=3'; </script>";
}else{
	
	$sql = mysqli_query($koneksi, "DELETE FROM pegawai WHERE nip = '$_GET[id]'");
	echo "<script type='text/javascript'> document.location = '?page=pegawai&msg=1'; </script>";
}
?>
