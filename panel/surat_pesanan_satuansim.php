<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";

$satuan = addslashes(ucfirst($_POST['satuan']));

$sql_cek = "SELECT * FROM pesanan_item WHERE item_pesanan = '$satuan'";
$tampil_cek = mysqli_query($koneksi, $sql_cek);
$data_cek = mysqli_fetch_array($tampil_cek);

    
    if ($data_cek['item_pesanan'] == $satuan){
    	echo "<script type='text/javascript'> document.location = '?page=supkat&msg=3'; </script>";
	}else{		
		$sql = mysqli_query($koneksi, "INSERT INTO pesanan_item VALUES ('$satuan')");
    	echo "<script type='text/javascript'> document.location = '?page=supkat&msg=1'; </script>";
	}

?>