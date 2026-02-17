<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";
$ttd = addslashes($_POST['ttd']);
$nama = addslashes($_POST['nama']);
    
    $sql_cek = mysqli_query($koneksi, "select * from ttd where nip = '$nama'");
	$process = mysqli_fetch_array($sql_cek);

    
   
	if ($process['nip'] == $nama){
   		echo "<script type='text/javascript'> document.location = '?page=ttdt&msg=2'; </script>";
   	}else{
   		$sql= mysqli_query($koneksi, "INSERT INTO ttd VALUES (NULL,'$ttd','$nama')");
    	echo "<script type='text/javascript'> document.location = '?page=ttd&msg=3'; </script>";
	}

?>