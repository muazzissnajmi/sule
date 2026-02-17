<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";

$kategori = addslashes($_POST['kategori']);
$subkatergori = addslashes($_POST['subkatergori']);


    $sql = mysqli_query($koneksi, "INSERT INTO kategori_subpesanan VALUES ('','$subkatergori','$kategori')");
   

    
    if ($sql){
    	echo "<script type='text/javascript'> document.location = '?page=supkat&msg=1'; </script>";
	}else{
		echo "<script type='text/javascript'> document.location = '?page=supkat&msg=2'; </script>";
	}

?>