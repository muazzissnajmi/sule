<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";

$uraian = addslashes(ucfirst($_POST['uraian']));

$sql_cek = "SELECT * FROM pesanan_uraian WHERE uraian_barang = '$uraian'";
$tampil_cek = mysqli_query($koneksi, $sql_cek);
$data_cek = mysqli_fetch_array($tampil_cek);

    
    if ($data_cek['uraian_barang'] == $uraian){
    	echo "<script type='text/javascript'> document.location = '?page=supkat&msg=3'; </script>";
	}else{		
		$sql = mysqli_query($koneksi, "INSERT INTO pesanan_uraian VALUES ('$uraian')");
    	echo "<script type='text/javascript'> document.location = '?page=supkat&msg=1'; </script>";
	}

?>