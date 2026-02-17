<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";

$kota = addslashes(ucwords($_POST['kota']));


    $sql = mysqli_query($koneksi, "INSERT INTO kota VALUES ('','$kota')");
   

    
    if ($sql){
    	echo "<script type='text/javascript'> document.location = '?page=kt&msg=1'; </script>";
	}else{
		echo "<script type='text/javascript'> document.location = '?page=kt&msg=2'; </script>";
	}

?>