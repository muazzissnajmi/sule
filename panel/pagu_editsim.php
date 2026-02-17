<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";
$tahun = addslashes($_POST['tahun']);
$dalam_kota = addslashes($_POST['dalam_kota']);
$luar_kota = addslashes($_POST['luar_kota']);
$dalam_kota_kdh = addslashes($_POST['dalam_kota_kdh']);
$luar_kota_kdh = addslashes($_POST['luar_kota_kdh']);

    $sql= mysqli_query($koneksi, "UPDATE pagu SET pagu_dk_awal = '$dalam_kota', pagu_lk_awal = '$luar_kota', pagu_dk_kdh_awal = '$dalam_kota_kdh', pagu_lk_kdh_awal = '$luar_kota_kdh' WHERE tahun = '$tahun'");

    //$sql=mysqli_query($koneksi, "UPDATE barang SET nama_barang = '$barang', merek = '$merek' WHERE id_barang = '$id_barang'");
    
   if ($sql){
    	echo "<script type='text/javascript'> document.location = '?page=pge&id=$tahun&msg=1'; </script>";
	}else{
		echo "<script type='text/javascript'> document.location = '?page=pge&id=$tahun&msg=2'; </script>";
	}

?>