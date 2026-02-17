<?php include 'session.php'?>
<?php
include "../koneksi/koneksi.php";

$query = "SELECT max(id_spt) as maxKode FROM spt";
$hasil = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($hasil);
$kode = $data['maxKode'];

$noUrut = (int)substr($kode, 3, 5);
$noUrut++;
$char = "SPT";
$id_spt = $char . sprintf("%05s", $noUrut);


//$id_spt = addslashes($_POST['id_spt']);
$no_spt = addslashes($_POST['no_spt']);
$tgl_spt = addslashes($_POST['tgl_spt']);
$memberi_perintah = addslashes($_POST['memberi_perintah']);
$pejabat_berwenang = addslashes($_POST['pejabat_berwenang']);
$pengikut = $_POST['pengikut'];
$dasar_penugasan = addslashes($_POST['dasar_penugasan']);
//$ttd = addslashes($_POST['ttd']);
$keterangan = addslashes($_POST['keterangan']);
$nd = addslashes($_POST['nd_spt']);
$tgl_nd = addslashes($_POST['tgl_nd']);
$spd_cek = addslashes($_POST['spd']);

$sql_cek = mysqli_query($koneksi, "select * from spt where no_spt = '$no_spt'");
$process = mysqli_fetch_array($sql_cek);
$time = date('Y-m-d h:i:s');



if ($process['id_spt'] == $id_spt) {
	echo "<script type='text/javascript'> document.location = '?page=st&msg=2'; </script>";
}
else {

	$sql = mysqli_query($koneksi, "INSERT INTO spt VALUES ('$id_spt','$no_spt','$tgl_spt','Bupati Bireuen','$pejabat_berwenang','$dasar_penugasan','$keterangan','$spd_cek','','$nd','$tgl_nd', '$time')");

	foreach ($pengikut as $ikut) {

		$sql2 = mysqli_query($koneksi, "INSERT INTO pengikut VALUES (NULL,'$id_spt','$ikut')");
		if (!$sql2) {
			echo "Error inserting into pengikut table: " . mysqli_error($koneksi);
		}
	}

	echo "<script type='text/javascript'> document.location = '?page=spt&msg=4'; </script>";

}

?>