<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";

$sql_ = "SELECT * FROM dokumen WHERE id_dokumen = '$_GET[id]'";
$tampil_ = mysqli_query($koneksi, $sql_);     
$data_ = mysqli_fetch_array($tampil_);
$id_dokumen = $data_['id_dokumen'];
$id_spt = $data_['id_spt'];
$nama_file = "../img/kegiatan/".$data_['nama_file'];

if (file_exists($nama_file)) {
	unlink($nama_file);
}

	$sql = mysqli_query($koneksi, "DELETE FROM dokumen WHERE id_dokumen = '$_GET[id]'");
	echo "<script type='text/javascript'> document.location = '?page=upfv&id=$id_spt&msg=1'; </script>";

?>
